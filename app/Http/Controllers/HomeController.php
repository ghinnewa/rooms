<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Spatie\Permission\Models\Role;
=======
use Illuminate\Support\Facades\DB;
>>>>>>> setup

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

<<<<<<< HEAD
        return view('home');
=======
        $approvedCardsCount = Card::where('paid', 1)->count();
        $requestsCount = Card::where('paid', 0)->count();
        $expiredCardsCount = Card::where('expiration', '<', now())->count();
        $totalCardsCount = Card::count();


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

        return view('home', [
            'labels' => $labels,
            'data' => $data,
            'approvedCardsCount' => $approvedCardsCount,
            'requestsCount' => $requestsCount,
            'expiredCardsCount' => $expiredCardsCount,
            'totalCardsCount' => $totalCardsCount,
        ]);
>>>>>>> setup
    }
}
