<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;


use App\DataTables\CardDataTable;
use App\Models\Categories;
use Illuminate\Support\Facades\URL;
// use Illuminate\Support\Facades\Request;
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
        $this->middleware('CheckAdminRoles')->only('edit');

        $this->middleware('permission:cards index')->only('index');
        $this->middleware('permission:cards show')->only('show');
        $this->middleware('permission:cards create')->only('create');
        // $this->middleware('permission:cards edit')->only('edit');
        $this->middleware('permission:cards store')->only('store');
        // $this->middleware('permission:cards destroy')->only('destroy');
        $this->middleware('permission:cards update')->only('update');
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
     * Display a listing of the Card.
     *
     * @param CardDataTable $cardDataTable
     *
     * @return Response
     */
    public function exp(CardDataTable $cardDataTable)
    {
        return $cardDataTable->render('cards.exp');
    }

    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function create()
    {
        $categories = ['' => 'Please Select a '] + Categories::pluck('name_ar', 'id')->toArray();
        $cities = [
            "Tripoli" => "طرابلس",
            "Benghazi" => "بنغازي",
            "Misrata" => "مصراتة",
            "Zawiya" => "الزاوية",
            "Bayda" => "البيضاء",
            "Gharyan" => "غريان",
            "Tobruk" => "طبرق",
            "Ajdabiya" => "اجدابيا",
            "Zliten" => "زليتن",
            "Derna" => "درنة",
            "Sabha" => "سبها",
            "Khoms" => "الخمس",
            "Sabratha" => "صبراتة",
            "Zuwara" => "زوارة",
            "Kufra" => "الكفرة",
            "Marj" => "المرج",
            "Tocra" =>  "توكرة",
            "Tarhuna" =>  "ترهونة",
            "Sirte" =>  "سرت",
            "Msallata" =>  "مسلاتة",
            "Bani Walid" =>  "بني وليد",
            "Jumayl" =>  "الجميل",
            "Sorman" =>  "صرمان",
            "Al Gseibat" =>  "القصيبات",
            "Shahhat" =>  "شحات",

        ];

        return view('cards.create', compact('categories', 'cities'));
    }
    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function publicForm()
    {
        $categories = ['' => 'Please Select a '] + Categories::pluck('name_ar', 'id')->toArray();
        $cities = [
            "Tripoli" => "طرابلس",
            "Benghazi" => "بنغازي",
            "Misrata" => "مصراتة",
            "Zawiya" => "الزاوية",
            "Bayda" => "البيضاء",
            "Gharyan" => "غريان",
            "Tobruk" => "طبرق",
            "Ajdabiya" => "اجدابيا",
            "Zliten" => "زليتن",
            "Derna" => "درنة",
            "Sabha" => "سبها",
            "Khoms" => "الخمس",
            "Sabratha" => "صبراتة",
            "Zuwara" => "زوارة",
            "Kufra" => "الكفرة",
            "Marj" => "المرج",
            "Tocra" =>  "توكرة",
            "Tarhuna" =>  "ترهونة",
            "Sirte" =>  "سرت",
            "Msallata" =>  "مسلاتة",
            "Bani Walid" =>  "بني وليد",
            "Jumayl" =>  "الجميل",
            "Sorman" =>  "صرمان",
            "Al Gseibat" =>  "القصيبات",
            "Shahhat" =>  "شحات",

        ];
        return view('publicForm', compact('categories', 'cities'));
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
    // dd($request);
        $input['image'] = $this->cardRepository->filesFromDashboard($request->file('image'), 'profile');
        $input['identity_file1'] = $this->cardRepository->filesFromDashboard($request->file('identity_file1'), 'identity_file1');
        $input['identity_file2'] = $this->cardRepository->filesFromDashboard($request->file('identity_file2'), 'identity_file2');
    
        $input['paid'] = 0;


        $path = 'qrcode-' . time() . '.svg';
        $output_file = 'public/qr-code/' . $path;
        $input['qrcode'] = $path;
        $card = $this->cardRepository->create($input);
        $card->membership_number = '00' + 1000 + $card->id;
        $card->save();
        $image = QrCode::size(200)->errorCorrection('H')
            ->generate('http://glucc.ly/card/?id=' . $card->id . '&lang=ar');
        Storage::disk('local')->put($output_file, $image);
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
        $categories = ['' => 'Please Select a '] + Categories::pluck('name_ar', 'id')->toArray();
        $cities = [
            "Tripoli" => "طرابلس",
            "Benghazi" => "بنغازي",
            "Misrata" => "مصراتة",
            "Zawiya" => "الزاوية",
            "Bayda" => "البيضاء",
            "Gharyan" => "غريان",
            "Tobruk" => "طبرق",
            "Ajdabiya" => "اجدابيا",
            "Zliten" => "زليتن",
            "Derna" => "درنة",
            "Sabha" => "سبها",
            "Khoms" => "الخمس",
            "Sabratha" => "صبراتة",
            "Zuwara" => "زوارة",
            "Kufra" => "الكفرة",
            "Marj" => "المرج",
            "Tocra" =>  "توكرة",
            "Tarhuna" =>  "ترهونة",
            "Sirte" =>  "سرت",
            "Msallata" =>  "مسلاتة",
            "Bani Walid" =>  "بني وليد",
            "Jumayl" =>  "الجميل",
            "Sorman" =>  "صرمان",
            "Al Gseibat" =>  "القصيبات",
            "Shahhat" =>  "شحات",

        ];

        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        return view('cards.edit')->with('card', $card)->with('categories', $categories)->with('cities', $cities);
    }
    /**
     * Show the form for editing the specified Card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function paid(Request $request)
    {
        $card = $this->cardRepository->find($request->id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }


        // Get the selected expiration period from the form input
        $expirationPeriod = $request->expiration;

        // Calculate the expiration date based on the selected expiration period
        switch ($expirationPeriod) {
            case '6m':
                $expirationDate = Carbon::now()->addMonths(6);
                break;
            case '1y':
                $expirationDate = Carbon::now()->addYears(1);
                break;
            case '2y':
                $expirationDate = Carbon::now()->addYears(2);
                break;
        }
        // dd($expirationDate);
        // Save the expiration date to the card
        $card->expiration = $expirationDate;
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

        $input = $request->all();
        if (!empty($request->file('image'))) {
            $input['image'] = $this->cardRepository->filesFromDashboard($request->file('image'), 'profile');
        }
        if (!empty($request->file('identity_file1'))) {
            $input['identity_file1'] = $this->cardRepository->filesFromDashboard($request->file('identity_file1'), 'identity_file1');
        }
        if (!empty($request->file('identity_file2'))) {
            $input['identity_file2'] = $this->cardRepository->filesFromDashboard($request->file('identity_file2'), 'identity_file2');
        }
        // $input['paid'] =  $card->paid;

        $card = $this->cardRepository->update($input, $id);
        $card->membership_number = '00' + 1000 + $card->id;
        $card->save();

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
