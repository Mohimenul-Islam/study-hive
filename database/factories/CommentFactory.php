<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'resource_id' => Resource::factory(),
            'parent_id' => null,
            'content' => $this->faker->paragraph(rand(1, 3)),
        ];
    }

    /**
     * Create a reply comment.
     */
    public function reply(Comment $parent): static
    {
        return $this->state(fn(array $attributes) => [
            'parent_id' => $parent->id,
            'resource_id' => $parent->resource_id,
        ]);
    }
}
