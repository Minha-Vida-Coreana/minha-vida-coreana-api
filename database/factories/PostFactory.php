<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Bluemmb\Faker\PicsumPhotosProvider;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new PicsumPhotosProvider($faker));
        $title = $this->faker->sentence(3);

        return [
            'user_id'       => User::pluck('id')->random(),
            'title'         => $title,
            'slug'          => Str::slug($title),
            'content'       => $this->faker->paragraph(),
            'image'         => $faker->imageUrl(640, 480, true),
        ];
    }
}
