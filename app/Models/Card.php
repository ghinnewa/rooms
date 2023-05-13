<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Card
 * @package App\Models
 * @version May 12, 2023, 5:02 pm UTC
 *
 * @property \App\Models\Category $category
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
 * @property integer $category_id
 * @property string $facebook_url
 * @property string $twitter_url
 * @property string $linkedin_url
 * @property string $company_ar
 * @property string $company_en
 * @property string $company_email
 * @property string $instagram_url
 * @property string $youtube_url
 * @property string $identity_file1
 * @property string $identity_file2
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
        'paid',
        'category_id',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'company_ar',
        'company_en',
        'company_email',
        'instagram_url',
        'youtube_url',
        'identity_file1',
        'identity_file2'
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
        'paid' => 'boolean',
        'category_id' => 'integer',
        'facebook_url' => 'string',
        'twitter_url' => 'string',
        'linkedin_url' => 'string',
        'company_ar' => 'string',
        'company_en' => 'string',
        'company_email' => 'string',
        'instagram_url' => 'string',
        'youtube_url' => 'string',
        'identity_file1' => 'string',
        'identity_file2' => 'string'
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
        'membership_number' => '',
        'phone1' => 'required|string|numeric',
        'phone2' => 'required|string|numeric',
        'email' => 'required|string|email',
        'website' => 'nullable|url',
        'qrcode' => '',
        'image' => 'required',
        'paid' => '',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'category_id' => 'required',
        'facebook_url' => 'nullable|url|regex:/^(https?:\/\/)?(www\.)?facebook\.com\/[a-zA-Z0-9(\.\?)?]/',
        'twitter_url' => 'nullable|url|regex:/^(https?:\/\/)?(www\.)?twitter\.com\/[a-zA-Z0-9(\.\?)?]/',
        'linkedin_url' => 'nullable|url|regex:/^(https?:\/\/)?(www\.)?linkedin\.com\/[a-zA-Z0-9(\.\?)?]/',
        'company_ar' => 'required|string|max:255',
        'company_en' => 'required|string|max:255',
        'company_email' => 'required|string|email',
        'instagram_url' => 'nullable|url|regex:/^(https?:\/\/)?(www\.)?instagram\.com\/[a-zA-Z0-9(\.\?)?]/',
        'youtube_url' => 'nullable|url|regex:/^(https?:\/\/)?(www\.)?youtube\.com\/[a-zA-Z0-9(\.\?)?]/',
        'identity_file1' => 'required',
        'identity_file2' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
}
