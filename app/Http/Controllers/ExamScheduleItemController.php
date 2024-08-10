<?php

namespace App\Http\Controllers;

use App\DataTables\ExamScheduleItemDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExamScheduleItemRequest;
use App\Http\Requests\UpdateExamScheduleItemRequest;
use App\Repositories\ExamScheduleItemRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExamScheduleItemController extends AppBaseController
{
    /** @var ExamScheduleItemRepository $examScheduleItemRepository*/
    private $examScheduleItemRepository;

    public function __construct(ExamScheduleItemRepository $examScheduleItemRepo)
    {
        $this->examScheduleItemRepository = $examScheduleItemRepo;
    }

    /**
     * Display a listing of the ExamScheduleItem.
     *
     * @param ExamScheduleItemDataTable $examScheduleItemDataTable
     *
     * @return Response
     */
    public function index(ExamScheduleItemDataTable $examScheduleItemDataTable)
    {
        return $examScheduleItemDataTable->render('exam_schedule_items.index');
    }

    /**
     * Show the form for creating a new ExamScheduleItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('exam_schedule_items.create');
    }

    /**
     * Store a newly created ExamScheduleItem in storage.
     *
     * @param CreateExamScheduleItemRequest $request
     *
     * @return Response
     */
    public function store(CreateExamScheduleItemRequest $request)
    {
        $input = $request->all();

        $examScheduleItem = $this->examScheduleItemRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/examScheduleItems.singular')]));

        return redirect(route('examScheduleItems.index'));
    }

    /**
     * Display the specified ExamScheduleItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $examScheduleItem = $this->examScheduleItemRepository->find($id);

        if (empty($examScheduleItem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/examScheduleItems.singular')]));

            return redirect(route('examScheduleItems.index'));
        }

        return view('exam_schedule_items.show')->with('examScheduleItem', $examScheduleItem);
    }

    /**
     * Show the form for editing the specified ExamScheduleItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $examScheduleItem = $this->examScheduleItemRepository->find($id);

        if (empty($examScheduleItem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/examScheduleItems.singular')]));

            return redirect(route('examScheduleItems.index'));
        }

        return view('exam_schedule_items.edit')->with('examScheduleItem', $examScheduleItem);
    }

    /**
     * Update the specified ExamScheduleItem in storage.
     *
     * @param int $id
     * @param UpdateExamScheduleItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamScheduleItemRequest $request)
    {
        $examScheduleItem = $this->examScheduleItemRepository->find($id);

        if (empty($examScheduleItem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/examScheduleItems.singular')]));

            return redirect(route('examScheduleItems.index'));
        }

        $examScheduleItem = $this->examScheduleItemRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/examScheduleItems.singular')]));

        return redirect(route('examScheduleItems.index'));
    }

    /**
     * Remove the specified ExamScheduleItem from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $examScheduleItem = $this->examScheduleItemRepository->find($id);

        if (empty($examScheduleItem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/examScheduleItems.singular')]));

            return redirect(route('examScheduleItems.index'));
        }

        $this->examScheduleItemRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/examScheduleItems.singular')]));

        return redirect(route('examScheduleItems.index'));
    }
}
