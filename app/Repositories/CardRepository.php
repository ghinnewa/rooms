<?php

namespace App\Repositories;

use App\Models\Card;
use App\Repositories\BaseRepository;

/**
 * Class CardRepository
 * @package App\Repositories
 * @version May 15, 2023, 2:04 pm UTC
*/

class CardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'identity_file2',
        'city'
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
        return Card::class;
    }
}
