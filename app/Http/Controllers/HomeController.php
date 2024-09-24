<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\User;
use App\Models\Category;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */public function index()
{
    // Current logic for approved cards, requests, expired cards, and total cards
    $approvedCardsCount = Card::where('paid', 1)->count();
    $requestsCount = Card::where('paid', 0)->count();
    $expiredCardsCount = Card::where('expiration', '<', Carbon::now())->count();
    $totalCardsCount = Card::count();
    $totalUsers = User::count();
    $totalSubjects = Subject::count(); // Count total subjects
    $user = auth()->user();
    $card = $user->card;
    if (!$card && Auth::user()->hasRole('student') ) {
        return view('subjects.locked'); // A special view for when the card is missing
    }
    if (auth()->user()->hasRole('student')) {
        return view('home', compact('card'));
    }
    // Get the data for Cards by Category
    $cards = DB::table('cards')
        ->select('category_id', DB::raw('count(*) as total'))
        ->groupBy('category_id')
        ->get();
    
    $categories = DB::table('categories')->get();
    
    $labels = [];
    $data = [];
    
    foreach ($cards as $card) {
        $category = $categories->where('id', $card->category_id)->first();
        if ($category) {
            $labels[] = $category->name_en;
            $data[] = $card->total;
        }
    }
    
    // Calculate Cards by Semester (from category_subject table)
    $cardsBySemester = DB::table('category_subject')
        ->join('user_subject', 'category_subject.subject_id', '=', 'user_subject.subject_id')
        ->join('cards', 'user_subject.user_id', '=', 'cards.user_id') // Assuming user_id links subjects to cards
        ->select('category_subject.semester', DB::raw('count(*) as total'))
        ->groupBy('category_subject.semester')
        ->get();
    
    return view('home', [
        'labels' => $labels,
        'data' => $data,
        'approvedCardsCount' => $approvedCardsCount,
        'requestsCount' => $requestsCount,
        'expiredCardsCount' => $expiredCardsCount,
        'totalSubjects' => $totalSubjects,
        'totalCardsCount' => $totalCardsCount,
        'totalUsers' => $totalUsers,
        'cardsBySemester' => $cardsBySemester, // Pass the semester data to the view
    ]);
}

}
