<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Repositories\BaseRepository;

/**
 * Class SubjectRepository
 * @package App\Repositories
 * @version July 31, 2024, 9:04 pm UTC
*/

class SubjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'points'
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
        return Subject::class;
    }
}
