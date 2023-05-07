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
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
