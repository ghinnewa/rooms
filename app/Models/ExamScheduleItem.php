<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ExamScheduleItem
 * @package App\Models
 * @version August 9, 2024, 6:02 pm UTC
 *
 * @property \App\Models\Category $category
 * @property \App\Models\ExamSchedule $examSchedule
 * @property \App\Models\Subject $subject
 * @property integer $exam_schedule_id
 * @property string $exam_date
 * @property integer $category_id
 * @property integer $subject_id
 * @property string $semester
 * @property time $start_time
 * @property time $end_time
 */
class ExamScheduleItem extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'exam_schedule_items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'exam_schedule_id',
        'exam_date',
        'category_id',
        'subject_id',
        'semester',
        'start_time',
        'end_time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'exam_schedule_id' => 'integer',
        'exam_date' => 'date',
        'category_id' => 'integer',
        'subject_id' => 'integer',
        'semester' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'exam_schedule_id' => 'required',
        'exam_date' => 'required',
        'category_id' => 'required',
        'subject_id' => 'required',
        'semester' => 'required|string|max:255',
        'start_time' => 'required',
        'end_time' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function examSchedule()
    {
        return $this->belongsTo(\App\Models\ExamSchedule::class, 'exam_schedule_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id');
    }
}
