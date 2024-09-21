<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Card;
use App\Models\User;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade as PDF;


class ReportController extends Controller
{
    public function export()
    {
        // Fetch data to be included in the report
        $approvedCardsCount = Card::where('paid', 1)->count();
        $requestsCount = Card::where('paid', 0)->count();
        $expiredCardsCount = Card::where('expiration', '<', Carbon::now())->count();
        $totalCardsCount = Card::count();
        $totalUsers = User::count();
        $totalSubjects = Subject::count();
        $totalCards = Card::count();
        $approvedCardsPercentage = ($totalCardsCount > 0) ? ($approvedCardsCount / $totalCardsCount) * 100 : 0;
        $pendingRequestsCount = Card::where('paid', 0)->count();

        $categoryDistribution = DB::table('cards')
            ->select('category_id', DB::raw('count(*) as total'), DB::raw('(count(*) / ' . $totalCards . ') * 100 as percentage'))
            ->groupBy('category_id')
            ->get();
            $cardsByCategory = Card::selectRaw('category_id, count(*) as total')
            ->groupBy('category_id')
            ->with('category') // Get related category
            ->get();
        $cardsBySemester = DB::table('category_subject')
            ->join('user_subject', 'category_subject.subject_id', '=', 'user_subject.subject_id')
            ->join('cards', 'user_subject.user_id', '=', 'cards.user_id')
            ->select('category_subject.semester', DB::raw('count(*) as total'))
            ->groupBy('category_subject.semester')
            ->get();

        // Pass data to the view
        $data = [
            'approvedCardsCount' => $approvedCardsCount,
            'pendingRequestsCount' => $pendingRequestsCount,
            'cardsByCategory' => $cardsByCategory,
            'approvedCardsPercentage' => $approvedCardsPercentage,
            'requestsCount' => $requestsCount,
            'expiredCardsCount' => $expiredCardsCount,
            'categoryDistribution' => $categoryDistribution,
            'totalCardsCount' => $totalCardsCount,
            'totalUsers' => $totalUsers,
            'totalSubjects' => $totalSubjects,
            'cardsBySemester' => $cardsBySemester,
        ];

        // You can generate a PDF or any other format for export
        $pdf = PDF::loadView('export', $data);

        return $pdf->download('report.pdf');
    }

public function exportPdf()
{
    $totalUsers = User::count();
    $totalSubjects = Subject::count();
    $approvedCardsCount = Card::where('paid', 1)->count();
    // Include all other data as shown in the previous steps...

    $pdf = PDF::loadView('reports.export', compact(
        'totalUsers', 'totalSubjects', 'approvedCardsCount', 'pendingRequestsCount', 
        'expiredCardsCount', 'totalCardsCount', 'approvedCardsPercentage', 
        'usersByRole', 'cardsByCategory', 'cardsBySemester'
    ));

    return $pdf->download('system_report.pdf');
}
}
