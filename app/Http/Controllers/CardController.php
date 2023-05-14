<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use App\DataTables\CardDataTable;
use App\Models\Categories;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\CreateCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Repositories\CardRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Generator as GlobalGenerator;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\Generator as MockObjectGenerator;
use Response;
use SimpleSoftwareIO\QrCode\Generator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CardController extends AppBaseController
{
    /** @var CardRepository $cardRepository*/
    private $cardRepository;
    private $attachmentPath = 'public/identity_file2/';

    public function __construct(CardRepository $cardRepo)
    {
        $this->cardRepository = $cardRepo;
    }

    /**
     * Display a listing of the Card.
     *
     * @param CardDataTable $cardDataTable
     *
     * @return Response
     */
    public function index(CardDataTable $cardDataTable)
    {
        return $cardDataTable->render('cards.index');
    }
    /**
     * Display a listing of the Card.
     *
     * @param CardDataTable $cardDataTable
     *
     * @return Response
     */
    public function requests(CardDataTable $cardDataTable)
    {
        return $cardDataTable->render('cards.requests');
    }

    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function create()
    {
        $categories = ['' => 'Please Select a '] + Categories::pluck('name_ar', 'id')->toArray();
        return view('cards.create', compact('categories'));
    }
    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function publicForm()
    {
        $categories = ['' => 'Please Select a '] + Categories::pluck('name_ar', 'id')->toArray();
        return view('publicForm', compact('categories'));
    }

    /**
     * Store a newly created Card in storage.
     *
     * @param CreateCardRequest $request
     *
     * @return Response
     */
    public function store(CreateCardRequest $request)
    {

        //save image
        $previousUrl = URL::previous();
        $previousRouteName = Route::getRoutes()->match(Request::create($previousUrl))->getName();

        $input = $request->all();

        $input['image'] = $this->cardRepository->files($request->file('image'), 'profile');
        $input['identity_file1'] = $this->cardRepository->files($request->file('identity_file1'), 'identity_file1');
        $input['identity_file2'] = $this->cardRepository->files($request->file('identity_file2'), 'identity_file2');
        //generate qr code
        if ($previousRouteName == 'cards.create') $input['paid'] = 1;
        if ($previousRouteName == 'requests') $input['paid'] = 0;

        $path = 'qrcode-' . time() . '.svg';
        $output_file = 'public/qr-code/' . $path;
        $input['qrcode'] = $path;
        $card = $this->cardRepository->create($input);
        $card->membership_number = '00' + 1000 + $card->id;
        $card->save();
        $image = QrCode::size(200)->errorCorrection('H')
            ->generate('https://rooms.test/card/' . $card->id);
        Storage::disk('local')->put($output_file, $image);
        Flash::success('Card saved successfully.');

        if ($previousRouteName == 'cards.create') return redirect(route('cards.index'));
        if ($previousRouteName == 'publicForm') return redirect(route('publicForm'));
    }

    /**
     * Display the specified Card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        return view('cards.show')->with('card', $card);
    }

    /**
     * Show the form for editing the specified Card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        return view('cards.edit')->with('card', $card);
    }
    /**
     * Show the form for editing the specified Card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function paid($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }
        $card->paid = 1;
        $card->save();
        return view('cards.show')->with('card', $card);
    }
    /**
     * Display the specified Card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function showpublic($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return view('card')->with('card', $card);
        }

        return view('card')->with('card', $card);
    }
    /**
     * Update the specified Card in storage.
     *
     * @param int $id
     * @param UpdateCardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCardRequest $request)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        $card = $this->cardRepository->update($request->all(), $id);

        Flash::success('Card updated successfully.');

        return redirect(route('cards.index'));
    }

    /**
     * Remove the specified Card from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        $this->cardRepository->delete($id);

        Flash::success('Card deleted successfully.');

        return redirect(route('cards.index'));
    }

    public function downloadAttachment($folder, $attachURL)
    {
        // TODO: handel file not found error.
        // TODO: remove this unnecessary method
        return Storage::download('public/' . $folder . '/' . $attachURL);
    }
}
