<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_index_page_loads_successfully(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function test_a_task_can_be_created(): void
    {
        $payload = [
            'title' => 'Write assessment summary',
            'description' => 'Prepare and submit final summary',
            'status' => 'pending',
            'due_date' => '2026-04-20',
        ];

        $response = $this->post(route('tasks.store'), $payload);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'title' => $payload['title'],
            'description' => $payload['description'],
            'status' => $payload['status'],
        ]);
        $this->assertSame(
            $payload['due_date'],
            Task::where('title', $payload['title'])->firstOrFail()->due_date->format('Y-m-d')
        );
    }

    public function test_a_task_can_be_updated(): void
    {
        $task = Task::factory()->create();

        $updatedData = [
            'title' => 'Updated task title',
            'description' => 'Updated description',
            'status' => 'completed',
            'due_date' => '2026-04-25',
        ];

        $response = $this->put(route('tasks.update', $task), $updatedData);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => $updatedData['title'],
            'description' => $updatedData['description'],
            'status' => $updatedData['status'],
        ]);
        $this->assertSame(
            $updatedData['due_date'],
            $task->fresh()->due_date->format('Y-m-d')
        );
    }

    public function test_a_task_can_be_deleted(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
