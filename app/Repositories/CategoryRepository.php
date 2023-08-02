<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version May 17, 2023, 7:56 pm UTC
*/

class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_ar',
        'name_en',
        'image'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
    public function findWithCards($id)
    {
        return Category::with(['cards' => function ($query) {
            $query->where('paid', 1);
        }])->find($id);    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Category::class;
    }
}
