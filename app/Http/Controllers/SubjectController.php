<?php

namespace App\Http\Controllers;
use App\Models\Subject;

use App\DataTables\SubjectDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Repositories\SubjectRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SubjectController extends AppBaseController
{
    /** @var SubjectRepository $subjectsRepository*/
    private $subjectsRepository;

    public function __construct(SubjectRepository $subjectsRepo)
    {
        $this->subjectsRepository = $subjectsRepo;
    }

    /**
     * Display a listing of the Subject.
     *
     * @param SubjectDataTable $subjectsDataTable
     *
     * @return Response
     */
    public function index(SubjectDataTable $subjectsDataTable)
    {
        return $subjectsDataTable->render('subjects.index');
    }

    /**
     * Show the form for creating a new Subject.
     *
     * @return Response
     */
    public function create()
    {
        $subjects = Subject::pluck('title', 'id');
        return view('subjects.create')->with('subjects', $subjects);
    }
    
    /**
     * Store a newly created Subject in storage.
     *
     * @param CreateSubjectRequest $request
     *
     * @return Response
     */
    public function store(CreateSubjectRequest $request)
    {
        $input = $request->all();

        $subjects = $this->subjectsRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/subjects.singular')]));

        return redirect(route('subjects.index'));
    }

    /**
     * Display the specified Subject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subjects = $this->subjectsRepository->find($id);

        if (empty($subjects)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subjects.singular')]));

            return redirect(route('subjects.index'));
        }

        return view('subjects.show')->with('subjects', $subjects);
    }

    /**
     * Show the form for editing the specified Subject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subject = $this->subjectsRepository->find($id);
    
        if (empty($subject)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subjects.singular')]));
            return redirect(route('subjects.index'));
        }
    
        $subjects = Subject::pluck('title', 'id');
 
        return view('subjects.edit')->with('subjects', $subjects)->with('subject', $subject);
    }

    /**
     * Update the specified Subject in storage.
     *
     * @param int $id
     * @param UpdateSubjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubjectRequest $request)
    {
        $subjects = $this->subjectsRepository->find($id);

        if (empty($subjects)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subjects.singular')]));

            return redirect(route('subjects.index'));
        }

        $subjects = $this->subjectsRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/subjects.singular')]));

        return redirect(route('subjects.index'));
    }

    /**
     * Remove the specified Subject from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subjects = $this->subjectsRepository->find($id);

        if (empty($subjects)) {
            Flash::error(__('messages.not_found', ['model' => __('models/subjects.singular')]));

            return redirect(route('subjects.index'));
        }

        $this->subjectsRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/subjects.singular')]));

        return redirect(route('subjects.index'));
    }
}
