<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Notifications\CardApprovalNotification;
use App\Notifications\CardCreatedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

use App\DataTables\CardDataTable;
use App\Models\Category;
use App\Models\User;
use App\Models\Card;
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
        // $this->middleware('CheckAdminRoles')->only('edit');

        $this->middleware('permission:cards.index')->only('index');
        $this->middleware('permission:cards.show')->only('show');
        $this->middleware('permission:cards.create')->only('create');
        $this->middleware('permission:cards.edit')->only('edit');
        $this->middleware('permission:cards.store')->only('store');
        $this->middleware('permission:cards.destroy')->only('destroy');
        $this->middleware('permission:cards.update')->only('update');
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
        //  dd("stop");

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
        $categories = ['' => 'Please Select a '] + Category::pluck('name_ar', 'id')->toArray();

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
        // Check if the user is an admin or super admin | admin
        if (Auth::user()->hasAnyRole(['admin', 'super admin'])) {
            $students = User::role('student')->pluck('name', 'id'); // Get all students
            return view('cards.create', compact('students', 'categories', 'cities'));
        }
        $user = auth()->user();
        if ($user->card  && auth()->user()->hasRole('student')) {
            // Redirect the user back with an error message
            return redirect()->route('my.card')->with('error', 'You already have a card.');
        }


        return view('cards.create', compact('categories', 'cities'));
    }
    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function publicForm()
    {
        $categories = ['' => 'Please Select a '] + Category::pluck('name_ar', 'id')->toArray();
        ddd($categories);
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
        // Handle file uploads
        $input = $request->all();
        $input['image'] = $this->cardRepository->filesFromDashboard($request->file('image'), 'profile');
        $input['identity_file1'] = $this->cardRepository->filesFromDashboard($request->file('identity_file1'), 'identity_file1');
        $input['identity_file2'] = $this->cardRepository->filesFromDashboard($request->file('identity_file2'), 'identity_file2');
  
      

        // Assign user_id if the role is student
        if (auth()->user()->hasRole('student')) {
            $input['user_id'] = auth()->id();
            $user = auth()->user();
            $subjects = $user->subjects;
        }

        // Set default values
        $input['paid'] = 0;

        // Prepare the QR code path
        $path = 'qrcode-' . time() . '.svg';
        $output_file = 'public/qr-code/' . $path;

        // Include the QR code path in the input array before creating the card
        $input['qrcode'] = $path;

        // Create the card and generate its ID
        $card = $this->cardRepository->create($input);

        // Generate the membership number

        // Save the card with the updated membership number
        $card->save();
      
        // Assign user_id if the role is student
        if (auth()->user()->hasRole('student')) {

            // Notify super admin | admins about the new card
            $systemAdmins = User::role('admin')->get();
           
            Notification::send($systemAdmins, new CardCreatedNotification($card));
        }else{
            $subjects = $card->user->subjects;
        }

        // Prepare data for the QR code (without expiration date)
        $cardData = [
            'id' => $card->id,
            'name' => $card->name_ar, // or name_en depending on your use case
            'hash' => hash('sha256', $card->id . $card->name_ar . config('app.key'))
        ];

        // Convert data to JSON
        $qrData = json_encode($cardData);
        $semester = $card->calculateSemester();
        if (!$semester) {
            $semester = 'no data available';
        }
        // Fetch the user who owns the card
   

    // Load the subjects assigned to this user (student)
  
        // Generate the QR code image
        $qrCodeImage = QrCode::size(200)->errorCorrection('H')->generate($qrData);
        Storage::disk('local')->put($output_file, $qrCodeImage);

        Flash::success('Card saved successfully.');

        return view('cards.show')->with('card', $card)->with('semester', $semester)->with('subjects', $subjects);
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
    // Find the card by ID
    $card = $this->cardRepository->find($id);

    // Check if the card exists
    if (empty($card)) {
        Flash::error('Card not found');
        return redirect(route('cards.index'));
    }

    // Calculate the semester based on the card's data
    $semester = $card->calculateSemester();
    
    if ($semester===null) {
        $semester = 'no data available';
    }

    // Fetch the user who owns the card
    $user = User::find($card->user_id);

    // Load the subjects assigned to this user (student)
    $subjects = $user->subjects;

    // Check if the logged-in user is authorized to view the card
    if (Auth::user()->hasAnyRole(['admin', 'super admin']) || $card->user_id === Auth::id()) {
        return view('cards.show', compact('card', 'semester', 'subjects'));
    } else {
        // If unauthorized, abort with 403
        abort(403, 'Unauthorized action.');
    }
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

        $categories = ['' => 'Please Select a '] + Category::pluck('name_ar', 'id')->toArray();
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
        if (auth()->user()->hasRole('student') && $card->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        if (empty($card)) {
            Flash::error('Card not found');
            return redirect(route('cards.index'));
        }
        if (Auth::user()->hasAnyRole(['admin', 'super admin'])) {
            $students = User::role('student')->pluck('name', 'id'); // Get all students
            return view('cards.edit', compact('card', 'students', 'categories', 'cities'));
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
     
         // Calculate the expiration date based on the selected expiration period
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
    default:
        $expirationDate = Carbon::now(); // Default to the current date if none is selected
        break;
}
     
         // Save the expiration date and mark the card as paid (approved)
         $card->expiration = $expirationDate;
         $card->paid = 1;

         $card->save();
     $semester = $card->calculateSemester();
    if (!$semester) {
        $semester = 'لا يوجد مواد';
    }
         // Send the notification to the student that the card has been approved
         $card->user->notify(new CardApprovalNotification($card, 'approved'));
         $user = User::find($card->user_id);

         $subjects = $user->subjects;

         Flash::success('تم قبول البطاقة');
         return view('cards.show')->with('card', $card)->with('semester', $semester)->with('subjects', $subjects);
     }
     

     public function reject(Request $request, $id)
     {
         $card = $this->cardRepository->find($id);
     
         if (empty($card)) {
             Flash::error('Card not found');
             return redirect(route('cards.index'));
         }
     
         // Mark as not approved and add a rejection comment
         $card->paid = 0;
         $card->comment = $request->input('comment');
         $card->save();
     
         // Notify the student about the rejection
         $card->user->notify(new CardApprovalNotification($card, 'rejected', $card->comment));
     
         Flash::success('تم رفض البطاقة');
         return redirect()->route('cards.show', $card->id);
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

        // Handle file uploads
        if (!empty($request->file('image'))) {
            $input['image'] = $this->cardRepository->filesFromDashboard($request->file('image'), 'profile');
        }
        if (!empty($request->file('identity_file1'))) {
            $input['identity_file1'] = $this->cardRepository->filesFromDashboard($request->file('identity_file1'), 'identity_file1');
        }
        if (!empty($request->file('identity_file2'))) {
            $input['identity_file2'] = $this->cardRepository->filesFromDashboard($request->file('identity_file2'), 'identity_file2');
        }

        // Check if the user is a student
        if (auth()->user()->hasRole('student')) {
            // Set the card to "request" state (unapproved)
            $input['paid'] = false;

            // Notify admin or super admin | admin about the update
            // Assuming you have a notification system set up
            // $adminUsers = \App\Models\User::role(['admin', 'super admin | admin'])->get();
            // \Notification::send($adminUsers, new \App\Notifications\CardUpdatedByStudent($card));
        }

        // Update the card
        $card = $this->cardRepository->update($input, $id);

        // Update the membership number if needed
    
        $card->save();

        Flash::success('Card updated successfully.');

        return redirect()->route('cards.show', ['card' => $card->id]);
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
    public function printCards(Request $request)
{
    $cards = Card::query();

    // If card IDs are passed, filter by those IDs
    if ($request->has('card_ids')) {
        $cardIds = explode(',', $request->input('card_ids'));
        $cards->whereIn('id', $cardIds);
    }

    // Fetch the filtered cards
    $cards = $cards->get();

    // Pass the cards to the print view
    return view('cards.print', compact('cards'));
}

    public function myCard()
    {
        $user = auth()->user();
        $card = $user->card;
        $semester = $card->calculateSemester();
    
        if ($semester===null) {
            $semester = 'no data available';
        }
        if (!$card && Auth::user()->hasRole('student')) {
            return view('subjects.locked'); 
            // A special view for when the card is missing
        }
        // Retrieve the card associated with the currently authenticated user
        $card = $this->cardRepository->findWhere(['user_id' => auth()->id()])->first();
        $user = auth()->user();
        $subjects = $user->subjects;
        // If the card is not found, redirect back with an error
        if (empty($card)) {
            Flash::error('Card not found');
            return redirect()->back();
        }

        // Return the view with the user's card
        return view('cards.show')->with('card', $card)->with('subjects', $subjects)->with('semester', $semester);
    }
}
