<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'user_id'=>User::factory()->create(),
            'title'=>$this->faker->sentence,
            'post_image'=>$this->faker->imageUrl(900, 300),
            'body'=>$this->faker->paragraph
        ];
    }
}
