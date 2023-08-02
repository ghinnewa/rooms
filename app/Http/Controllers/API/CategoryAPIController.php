<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategoryAPIRequest;
use App\Http\Requests\API\UpdateCategoryAPIRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */

class CategoryAPIController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $categories = ['' => 'Please Select a '] + Category::pluck('name_ar', 'id')->toArray();


        return $this->sendResponse(
            $categories,
            __('messages.retrieved', ['model' => __('models/categories.plural')])
        );
    }


    /**
     * Display a listing of the Card.
     * GET|HEAD /cards
     *
     * @param Request $request
     * @return Response
     */
    public function categories(Request $request)
    {
        $cards = $this->categoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );


        return $this->sendResponse(
            $cards->toArray(),
            __('messages.retrieved', ['model' => __('models/cards.plural')])
        );
    }
    /**
     * Store a newly created Category in storage.
     * POST /categories
     *
     * @param CreateCategoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryAPIRequest $request)
    {
        $input = $request->all();

        $category = $this->categoryRepository->create($input);

        return $this->sendResponse(
            $category->toArray(),
            __('messages.saved', ['model' => __('models/categories.singular')])
        );
    }

    /**
     * Display the specified Category.
     * GET|HEAD /categories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->findWithCards($id);

        if (empty($category)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/categories.singular')])
            );
        }

        // $category= $category->cards;
        return $this->sendResponse(
            $category->toArray(),
            __('messages.retrieved', ['model' => __('models/categories.singular')])
        );
    }

    /**
     * Update the specified Category in storage.
     * PUT/PATCH /categories/{id}
     *
     * @param int $id
     * @param UpdateCategoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Category $category */
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/categories.singular')])
            );
        }

        $category = $this->categoryRepository->update($input, $id);

        return $this->sendResponse(
            $category->toArray(),
            __('messages.updated', ['model' => __('models/categories.singular')])
        );
    }

    /**
     * Remove the specified Category from storage.
     * DELETE /categories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/categories.singular')])
            );
        }

        $category->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/categories.singular')])
        );
    }
}
