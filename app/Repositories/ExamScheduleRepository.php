<?php

namespace App\Repositories;

use App\Models\ExamSchedule;
use App\Repositories\BaseRepository;

/**
 * Class ExamScheduleRepository
 * @package App\Repositories
 * @version August 9, 2024, 5:04 pm UTC
*/

class ExamScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year'
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
        return ExamSchedule::class;
    }
}
