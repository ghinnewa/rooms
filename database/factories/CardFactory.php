<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_ar' => $this->faker->word,
        'name_en' => $this->faker->word,
        'job_title_ar' => $this->faker->word,
        'job_title_en' => $this->faker->word,
        'membership_number' => $this->faker->word,
        'phone1' => $this->faker->word,
        'phone2' => $this->faker->word,
        'email' => $this->faker->word,
        'website' => $this->faker->word,
        'qrcode' => $this->faker->word,
        'image' => $this->faker->word,
        'paid' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'category_id' => $this->faker->word,
        'facebook_url' => $this->faker->word,
        'twitter_url' => $this->faker->word,
        'linkedin_url' => $this->faker->word,
        'company_ar' => $this->faker->word,
        'company_en' => $this->faker->word,
        'company_email' => $this->faker->word,
        'instagram_url' => $this->faker->word,
        'youtube_url' => $this->faker->word,
        'identity_file1' => $this->faker->word,
        'identity_file2' => $this->faker->word
        ];
    }
}
