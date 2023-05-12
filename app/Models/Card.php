<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Card
 * @package App\Models
 * @version May 9, 2023, 5:26 pm UTC
 *
 * @property string $name_ar
 * @property string $name_en
 * @property string $job_title_ar
 * @property string $job_title_en
 * @property string $membership_number
 * @property string $phone1
 * @property string $phone2
 * @property string $email
 * @property string $website
 * @property string $qrcode
 * @property string $image
 * @property boolean $paid
 */
class Card extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cards';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name_ar',
        'name_en',
        'job_title_ar',
        'job_title_en',
        'membership_number',
        'phone1',
        'phone2',
        'email',
        'website',
        'qrcode',
        'image',
        'paid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name_ar' => 'string',
        'name_en' => 'string',
        'job_title_ar' => 'string',
        'job_title_en' => 'string',
        'membership_number' => 'string',
        'phone1' => 'string',
        'phone2' => 'string',
        'email' => 'string',
        'website' => 'string',
        'qrcode' => 'string',
        'image' => 'string',
        'paid' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'job_title_ar' => 'required|string|max:255',
        'job_title_en' => 'required|string|max:255',
        'membership_number' => 'required|string|max:255',
        'phone1' => 'required|string|max:255',
        'phone2' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'website' => 'nullable|string|max:255',
        'qrcode' => 'string|max:255',
        'image' => 'required|string|max:255',
        'paid' => 'required|boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
