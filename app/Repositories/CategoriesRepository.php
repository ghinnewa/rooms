<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Repositories\BaseRepository;

/**
 * Class CategoriesRepository
 * @package App\Repositories
 * @version May 11, 2023, 12:28 pm UTC
*/

class CategoriesRepository extends BaseRepository
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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Categories::class;
    }
}
