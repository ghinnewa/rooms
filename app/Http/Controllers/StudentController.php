<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StudentController extends Controller
{
    public function showCard()
    {
        $card = Auth::user()->card;
        return view('student.card', compact('card'));
    }

    public function showSubjects()
    {
        $subjects = Auth::user()->subjects;
        return view('student.subjects', compact('subjects'));
    }

    public function showExamSchedule()
    {
        $subjects = Auth::user()->subjects->pluck('id');
        $examSchedules = ExamSchedule::whereHas('items', function($query) use ($subjects) {
            $query->whereIn('subject_id', $subjects);
        })->get();

        return view('student.examSchedule', compact('examSchedules'));
    }
}
