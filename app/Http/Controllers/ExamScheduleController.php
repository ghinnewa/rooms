<?php

namespace App\Http\Controllers;

use App\DataTables\ExamScheduleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExamScheduleRequest;
use App\Http\Requests\UpdateExamScheduleRequest;
use App\Repositories\ExamScheduleRepository;
use Flash;
use App\DataTables\ExamScheduleItemDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\ExamSchedule;
use App\Models\ExamScheduleItem;
use App\Models\Subject;
use App\Models\Category;
use App\Http\Controllers\AppBaseController;
use Response;

class ExamScheduleController extends AppBaseController
{
    /** @var ExamScheduleRepository $examScheduleRepository*/
    private $examScheduleRepository;

    public function __construct(ExamScheduleRepository $examScheduleRepo)
    {
        $this->examScheduleRepository = $examScheduleRepo;
    }

    /**
     * Display a listing of the ExamSchedule.
     *
     * @param ExamScheduleDataTable $examScheduleDataTable
     *
     * @return Response
     */
    public function index(ExamScheduleDataTable $examScheduleDataTable)
    {
        return $examScheduleDataTable->render('exam_schedules.index');
    }

    /**
     * Show the form for creating a new ExamSchedule.
     *
     * @return Response
     */
    public function create()
    {

        $categories = Category::all();

        // Pass the categories to the view
        return view('exam_schedules.create', compact('categories'));
    }

    /**
     * Store a newly created ExamSchedule in storage.
     *
     * @param CreateExamScheduleRequest $request
     *
     * @return Response
     */
    public function store(CreateExamScheduleRequest $request)
    {
        // Create the exam schedule
        $examSchedule = $this->examScheduleRepository->create($request->only('year'));

        // Create associated exam schedule items
        foreach ($request->exams as $exam) {
            $examSchedule->items()->create([
                'exam_date' => $exam['exam_date'],
                'category_id' => $exam['category_id'],
                'subject_id' => $exam['subject_id'],
                'semester' => $exam['semester'],
                'start_time' => $exam['start_time'],
                'end_time' => $exam['end_time'],
            ]);
        }

        Flash::success('Exam Schedule created successfully.');

        return redirect(route('examSchedules.index'));
    }

    /**
     * Display the specified ExamSchedule.
     *
     * @param int $id
     * 
     * @param ExamScheduleItemDataTable $examScheduleItemDataTable
     * 
     * @return Response
     */
    public function show($id)
    {
        $examSchedule = ExamSchedule::findOrFail($id);

        // Retrieve the associated ExamScheduleItems
        $examScheduleItems = ExamScheduleItem::where('exam_schedule_id', $id)
            ->with(['category', 'subject'])
            ->get();

        return view('exam_schedules.show', compact('examSchedule', 'examScheduleItems'));
    }
    /**
     * Show the form for editing the specified ExamSchedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $examSchedule = ExamSchedule::findOrFail($id);
        $examScheduleItems = ExamScheduleItem::where('exam_schedule_id', $id)
            ->with(['category', 'subject'])
            ->get();

        $categories = Category::all();  // Load all categories
        $subjects = Subject::all();  // Load all subjects

        return view('exam_schedules.edit', compact('examSchedule', 'examScheduleItems', 'categories', 'subjects'));
    }

    /**
     * Update the specified ExamSchedule in storage.
     *
     * @param int $id
     * @param UpdateExamScheduleRequest $request
     *
     * @return Response
     */



    public function update(Request $request, $id)
    {
        $examSchedule = ExamSchedule::findOrFail($id);

        // Update the ExamSchedule details
        $examSchedule->year = $request->input('year');
        $examSchedule->save();

        // Track the IDs of the items that are updated or created
        $updatedItemIds = [];

        foreach ($request->input('exams') as $itemData) {
            if (isset($itemData['id']) && !empty($itemData['id'])) {
                // Update existing item
                $examScheduleItem = ExamScheduleItem::findOrFail($itemData['id']);
            } else {
                // Create a new item
                $examScheduleItem = new ExamScheduleItem();
                $examScheduleItem->exam_schedule_id = $examSchedule->id;
            }

            $examScheduleItem->exam_date = $itemData['exam_date'];
            $examScheduleItem->category_id = $itemData['category_id'];
            $examScheduleItem->subject_id = $itemData['subject_id'];
            $examScheduleItem->semester = $itemData['semester'];
            $examScheduleItem->start_time = $itemData['start_time'];
            $examScheduleItem->end_time = $itemData['end_time'];
            $examScheduleItem->save();

            // Add the ID to the list of updated or created items
            $updatedItemIds[] = $examScheduleItem->id;
        }

        // Optionally: Delete items that were not included in the update
        ExamScheduleItem::where('exam_schedule_id', $examSchedule->id)
            ->whereNotIn('id', $updatedItemIds)
            ->delete();

        return redirect()->route('examSchedules.show', $id)
            ->with('success', 'Exam schedule updated successfully.');
    }




    /**
     * Remove the specified ExamSchedule from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $examSchedule = $this->examScheduleRepository->find($id);

        if (empty($examSchedule)) {
            Flash::error(__('messages.not_found', ['model' => __('models/examSchedules.singular')]));

            return redirect(route('examSchedules.index'));
        }

        $this->examScheduleRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/examSchedules.singular')]));

        return redirect(route('examSchedules.index'));
    }
}
