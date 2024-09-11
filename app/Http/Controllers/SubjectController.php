<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Category;

use App\DataTables\SubjectDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;

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
        $user = auth()->user();
    $card = $user->card;

    if (!$card && Auth::user()->hasRole('student') ) {
        return view('subjects.locked'); // A special view for when the card is missing
    }
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
    public function showAddSubjectsForm()
    {
        
        $user = auth()->user();
        $categoryId = $user->card->category_id;
      
        $card = $user->card;
    
        if (!$card) {
            return view('subjects.locked'); // A special view for when the card is missing
        }
        // Get subjects related to the user's category
        $subjects = Subject::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->get();
    
        // Prepare prerequisite mapping
        $prerequisiteMapping = [];
        foreach ($subjects as $subject) {
            if ($subject->prerequisite_subject_id) {
                $prerequisiteMapping[$subject->prerequisite_subject_id][] = $subject->id;
            }
        }
    
        // Get the subjects the student has already selected
        $studentSubjects = $user->subjects()->pluck('subject_id')->toArray();
    
        return view('subjects.student', compact('subjects', 'studentSubjects', 'prerequisiteMapping'));
    }
    
    

    public function addSubject(Request $request)
{
    // Validate that subject_id is provided and exists in the subjects table
    $request->validate([
        'subject_id' => 'required|array', // Ensure it's an array of subject IDs
        'subject_id.*' => 'exists:subjects,id', // Ensure each ID exists in the subjects table
    ]);

    // Get the authenticated user (student)
    $student = auth()->user();

    // Delete all existing subjects related to the student
    $student->subjects()->detach();

    // Attach the new subjects to the student
    $student->subjects()->attach($request->input('subject_id'));

    // Redirect or return with a success message
    return redirect()->route('my.subjects')->with('success', 'Subjects updated successfully!');
}

    
}
