<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
/**
 * Class Card
 * @package App\Models
 * @version May 15, 2023, 2:04 pm UTC
 *
 * @property \App\Models\Category $category
 * @property string $name_ar
 * @property string $name_en

 * @property string $membership_number
 * @property string $national_number
 * @property string $phone1

 * @property string $qrcode
 * @property string $image
 * @property boolean $paid
 * @property integer $category_id
 * @property string $facebook_url
 * @property string $twitter_url
 * @property string $linkedin_url
 * @property string $instagram_url
 * @property string $youtube_url
 * @property string $identity_file1
 * @property string $identity_file2
 * @property string $city
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
       
        'membership_number',
        'national_number',
        'phone1',
       
        
        'qrcode',
        'image',
        'comment',
        'paid',
        'category_id',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
       
        'instagram_url',
        'youtube_url',
        'identity_file1',
        'identity_file2',
        'user_id',
        'city',
        'expiration'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name_ar' => 'string',
        'name_en' => 'string',
       
        'membership_number' => 'string',
        'national_number' => 'string',
        'phone1' => 'string',
        
       
       
        'qrcode' => 'string',
        'image' => 'string',
        'comment' => 'string',
        'paid' => 'boolean',
        'category_id' => 'integer',
        'facebook_url' => 'string',
        'twitter_url' => 'string',
        'linkedin_url' => 'string',
       
        'instagram_url' => 'string',
        'youtube_url' => 'string',
        'identity_file1' => 'string',
        'identity_file2' => 'string',
        'expiration' => 'date',
        'city' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
      
       
        'phone1' => 'required|string|max:255',
        
      

        'qrcode' => '',
        'image' => '',
        'expiration' => 'date|after:now',

        'paid' => 'boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'category_id' => 'nullable',
        'user_id' => 'nullable',
        'comment' => 'nullable',
        'facebook_url' => 'nullable|string|max:255',
        'twitter_url' => 'nullable|string|max:255',
        'linkedin_url' => 'nullable|string|max:255',
      
        'instagram_url' => 'nullable|string|max:255',
        'youtube_url' => 'nullable|string|max:255',
        'identity_file1' => '',
        'identity_file2' => '',
        'city' => 'required|string|max:255',




   
        'membership_number' => 'required|digits:6',  // Ensuring it is exactly 6 digits
        'national_number' => [
            'required',
            'regex:/^(1|2)[0-9]{11}$/',  // Must start with 1 or 2 and have exactly 12 digits
        ]
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
// App\Models\Card.php

// App\Models\Card.php

public function calculateSemester()
{
    // Assuming the relationship between user and subjects is already set up
    // We will use the category_subject table to get the maximum semester

    return DB::table('category_subject')
        ->join('user_subject', 'category_subject.subject_id', '=', 'user_subject.subject_id')
        ->where('user_subject.user_id', $this->user->id)
        ->max('category_subject.semester');
}


}
