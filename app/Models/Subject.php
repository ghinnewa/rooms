<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Subject
 * @package App\Models
 * @version July 31, 2024, 9:04 pm UTC
 *
 * @property string $title
 * @property string $points
 */
class Subject extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'subjects';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'points',
        'code',
        'prerequisite_subject_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'prerequisite_subject_id' => 'integer',
        'title' => 'string',
        'code' => 'string',
        'points' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'nullable|string|max:255',
        'code' => 'nullable|string|max:255',
        'points' => 'nullable|string|max:255',
        'prerequisite_subject_id' => 'nullable',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
     // Define the relationship to the prerequisite subject
     public function prerequisiteSubject()
     {
         return $this->belongsTo(Subject::class, 'prerequisite_subject_id');
     }
 
     // Define the inverse relationship if needed
     public function dependentSubject()
     {
         return $this->hasMany(Subject::class, 'prerequisite_subject_id');
     }
     public function categories()
     {
         return $this->belongsToMany(Category::class, 'category_subject', 'subject_id', 'category_id')
                     ->withPivot('semester')
                     ->withTimestamps();
     }
     
    
}
