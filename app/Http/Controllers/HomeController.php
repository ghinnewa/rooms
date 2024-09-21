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
     */
    public function index()
    {
        // Existing statistics
        $approvedCardsCount = Card::where('paid', 1)->count();
        $requestsCount = Card::where('paid', 0)->count();
        $expiredCardsCount = Card::where('expiration', '<', Carbon::now())->count();
        $totalCardsCount = Card::count();

        // Existing user checks and student-specific redirection
        $user = auth()->user();
        $card = $user->card;
        if (!$card && Auth::user()->hasRole('student')) {
            return view('subjects.locked'); // A special view for when the card is missing
        }
        if (auth()->user()->hasRole('student')) {
            return view('home', compact('card'));
        }

        // Existing chart data for cards by category
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

        $data[] += 0; // This ensures there is a data point even when no cards exist.

        // New data for subjects and users
        $totalUsers = User::count();
        $totalSubjects = Subject::count();

        // Cards by semester (new feature)
        $cardsBySemester = Card::selectRaw('semester, count(*) as total')
            ->groupBy('semester')
            ->get();

        // Pass data to the home view
        return view('home', [
            'labels' => $labels,
            'data' => $data,
            'approvedCardsCount' => $approvedCardsCount,
            'requestsCount' => $requestsCount,
            'expiredCardsCount' => $expiredCardsCount,
            'totalCardsCount' => $totalCardsCount,
            'totalUsers' => $totalUsers,
            'totalSubjects' => $totalSubjects,
            'cardsBySemester' => $cardsBySemester,
        ]);
    }
}
