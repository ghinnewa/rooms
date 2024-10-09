<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Http\UploadedFile;
use App\Models\Card;


class CardFactory extends Factory
{
    protected $model = Card::class;

   // database/factories/CardFactory.php
   

   public function definition()
   {
       return [
           'name_ar' => $this->faker->word,
           'name_en' => $this->faker->word,
           'membership_number' => $this->faker->numerify('######'),
           'national_number' => $this->faker->regexify('[12][0-9]{11}'), // National number starting with 1 or 2, 12 digits long
           'phone1' => $this->faker->phoneNumber,
           'qrcode' => $this->faker->uuid,
           'image' => UploadedFile::fake()->image('avatar.jpg', 100, 100), // Simulate an uploaded file
           'paid' => $this->faker->boolean,
           'category_id' => \App\Models\Category::factory(),
           'facebook_url' => $this->faker->url,
           'twitter_url' => $this->faker->url,
           'linkedin_url' => $this->faker->url,
           'instagram_url' => $this->faker->url,
           'youtube_url' => $this->faker->url,
           'identity_file1' => $this->faker->word,
           'identity_file2' => $this->faker->word,
           'city' => $this->faker->city,
           'added_by_user' => \App\Models\User::factory(),
           'expiration' => $this->faker->dateTimeBetween('now', '+1 year'),
           'job_title_en' => $this->faker->jobTitle,
           'user_id' => \App\Models\User::factory(),
       ];
   }
   


}
