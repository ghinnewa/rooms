<?php

namespace App\Repositories;

use App\Models\Card;
use App\Repositories\BaseRepository;

/**
 * Class CardRepository
 * @package App\Repositories
 * @version May 5, 2023, 10:31 pm UTC
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
        'paid'
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
