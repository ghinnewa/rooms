<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Repositories\CategoriesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CategoriesController extends AppBaseController
{
    /** @var CategoriesRepository $categoriesRepository*/
    private $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepo)
    {
        $this->categoriesRepository = $categoriesRepo;
        $this->middleware('permission:categories index')->only('index');
        $this->middleware('permission:categories show')->only('show');
        $this->middleware('permission:categories create')->only('create');
        $this->middleware('permission:categories edit')->only('edit');
        $this->middleware('permission:categories destroy')->only('destroy');
        $this->middleware('permission:categories store')->only('store');
        $this->middleware('permission:categories update')->only('update');
    }

    /**
     * Display a listing of the Categories.
     *
     * @param CategoriesDataTable $categoriesDataTable
     *
     * @return Response
     */
    public function index(CategoriesDataTable $categoriesDataTable)
    {
        return $categoriesDataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new Categories.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created Categories in storage.
     *
     * @param CreateCategoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoriesRequest $request)
    {
        $input = $request->all();

        $input['image'] = $this->categoriesRepository->filesFromDashboard($request->file('image'), 'categories');
        $categories = $this->categoriesRepository->create($input);

        Flash::success('Categories saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Categories.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified Categories.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('categories', $categories);
    }

    /**
     * Update the specified Categories in storage.
     *
     * @param int $id
     * @param UpdateCategoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoriesRequest $request)
    {

        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }
        $input = $request->all();

        $input['image'] = $this->categoriesRepository->filesFromDashboard($request->file('image'), 'categories');
        $categories = $this->categoriesRepository->update( $input, $id);

        Flash::success('Categories updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Categories from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        $this->categoriesRepository->delete($id);

        Flash::success('Categories deleted successfully.');

        return redirect(route('categories.index'));
    }
}
