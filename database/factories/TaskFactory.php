<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'Prepare weekly report',
                'Review pull request',
                'Plan sprint tasks',
                'Update project documentation',
                'Fix login form validation',
                'Test payment workflow',
                'Clean up old logs',
                'Follow up with client',
                'Deploy latest release',
                'Refactor task list page',
            ]),
            'description' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
            'due_date' => fake()->boolean()
                ? fake()->dateTimeBetween('tomorrow', '+30 days')->format('Y-m-d')
                : null,
        ];
    }
}
