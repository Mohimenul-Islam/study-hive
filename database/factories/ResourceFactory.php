<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'course_name' => $this->faker->words(2, true) . ' ' . $this->faker->regexify('[0-9]{3}'), // e.g., Computer Science 101, Mathematics 201
            'file_path' => 'resources/' . $this->faker->uuid() . '.' . $this->faker->randomElement(['pdf', 'doc', 'docx', 'ppt', 'pptx']),
        ];
    }
}
