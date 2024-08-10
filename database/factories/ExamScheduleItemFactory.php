<?php

namespace Database\Factories;

use App\Models\ExamScheduleItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamScheduleItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExamScheduleItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'exam_schedule_id' => $this->faker->word,
        'exam_date' => $this->faker->word,
        'category_id' => $this->faker->word,
        'subject_id' => $this->faker->word,
        'semester' => $this->faker->word,
        'start_time' => $this->faker->word,
        'end_time' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
