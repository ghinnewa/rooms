<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use Flash;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Category;

use App\Http\Controllers\AppBaseController;
use Response;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository $categoriesRepository*/
    private $categoriesRepository;

    public function __construct(CategoryRepository $categoriesRepo)
    {
        $this->categoriesRepository = $categoriesRepo;
        $this->middleware('permission:categories.index')->only('index');
        $this->middleware('permission:categories.show')->only('show');
        $this->middleware('permission:categories.create')->only('create');
        $this->middleware('permission:categories.edit')->only('edit');
        $this->middleware('permission:categories.destroy')->only('destroy');
        $this->middleware('permission:categories.store')->only('store');
        $this->middleware('permission:categories.update')->only('update');
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoriesDataTable
     *
     * @return Response
     */
    public function index(CategoryDataTable $categoriesDataTable)
    {
        return $categoriesDataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('categories.create')->with('subjects', $subjects);
    }


    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // Debugging the request object
        // ddd($request);
    
        $input = $request->all();
        $input['image'] = $this->categoriesRepository->filesFromDashboard($request->file('image'), 'categories');
        $category = $this->categoriesRepository->create($input);
    
        // Prepare the sync data with semester information
        $syncData = [];
        if (isset($input['subjects'])) {
            foreach ($input['subjects'] as $subjectId => $details) {
                if (isset($details['selected'])) {
                    $syncData[$subjectId] = ['semester' => $details['semester']];
                }
            }
        }
    
        // Sync subjects with semester information
        $category->subjects()->sync($syncData);
    
        Flash::success('Category saved successfully.');
    
        return redirect(route('categories.index'));
    }
    
    
    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $categories = $this->categoriesRepository->find($id);
        $categories = Category::with('subjects')->findOrFail($id);

        if (empty($categories)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
{
    $categories = $this->categoriesRepository->find($id);
    $subjects = Subject::all();

    if (empty($categories)) {
        Flash::error('Category not found');
        return redirect(route('categories.index'));
    }

    return view('categories.edit')->with('categories', $categories)->with('subjects', $subjects);
}
    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    
     public function update($id, Request $request)
     {
         $category = $this->categoriesRepository->find($id);
     
         if (empty($category)) {
             Flash::error('Category not found');
             return redirect(route('categories.index'));
         }
     
         $input = $request->all();
         $input['image'] = $this->categoriesRepository->filesFromDashboard($request->file('image'), 'categories');
 
         $category = $this->categoriesRepository->update($input, $id);
     
         // Prepare the sync data with semester information
         $syncData = [];
         if (isset($input['subjects'])) {
             foreach ($input['subjects'] as $subjectId => $details) {
                 if (isset($details['selected'])) {
                     $syncData[$subjectId] = ['semester' => $details['semester']];
                 }
             }
         }
 
         // Sync subjects with semester information
         $category->subjects()->sync($syncData);
     
         Flash::success('Category updated successfully.');
     
         return redirect(route('categories.index'));
     }
     

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        $this->categoriesRepository->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }
    public function getSubjects($categoryId)
    {
        $category = Category::with('subjects')->findOrFail($categoryId);

        return response()->json(['subjects' => $category->subjects]);
    }
    
    public function getSubjectDetails($categoryId, $subjectId)
    {
        $subject = Category::findOrFail($categoryId)
                    ->subjects()
                    ->where('subjects.id', $subjectId)
                    ->first();

        return response()->json(['semester' => $subject->pivot->semester]);
    }
}
