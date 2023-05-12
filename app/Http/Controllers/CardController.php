<?php

namespace App\Http\Controllers;

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
     * Store a newly created Card in storage.
     *
     * @param CreateCardRequest $request
     *
     * @return Response
     */
    public function store(CreateCardRequest $request)
    {

        $input = $request->all();
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;
        $file->storeAs('public/images/', $fileName);
        $input = $request->all();
        $input['image'] = $fileName;
         $path='qrcode-'. time() . '.svg';
        $output_file = 'public/qr-code/'.$path;
        $input['qrcode']=$path;

        $card = $this->cardRepository->create($input);
        $image = QrCode::size(200)->errorCorrection('H')
        ->generate('https://rooms.test/card/'.$card->id);
        Storage::disk('local')->put($output_file, $image);

        Flash::success('Card saved successfully.');

        return redirect(route('cards.index'));
    }

    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function publicForm()
    {
        return view('publicForm');
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
        dd($request)
        $input = $request->all();

        $card = $this->cardRepository->create($input);

        Flash::success('Card saved successfully.');

        return redirect(route('cards.index'));
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
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;
        $file->storeAs('public/images/', $fileName);
        $request = $request->all();
        $request['image'] = $fileName;
        $image = QrCode::size(200)->generate('https://www.google.com/');
            $path='qrcode-'. time() . '.svg';
        $output_file = 'public/qr-code/'.$path;

        Storage::disk('local')->put($output_file, $image);
        $request['qrcode']=$path;

        $card = $this->cardRepository->update($request, $id);

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
}
