<?php

namespace App\Repositories;

use App\Models\ExamScheduleItem;
use App\Repositories\BaseRepository;

/**
 * Class ExamScheduleItemRepository
 * @package App\Repositories
 * @version August 9, 2024, 6:02 pm UTC
*/

class ExamScheduleItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'exam_schedule_id',
        'exam_date',
        'category_id',
        'subject_id',
        'semester',
        'start_time',
        'end_time'
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
        return ExamScheduleItem::class;
    }
}
