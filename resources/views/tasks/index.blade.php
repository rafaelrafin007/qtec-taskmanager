@extends('layouts.app')

@section('title', 'Task Manager')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Task Manager</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($tasks->isEmpty())
        <div class="alert alert-info mb-0">
            No tasks yet. Click "Add Task" to create your first task.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle bg-white">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        @php
                            $badgeClass = match ($task->status) {
                                'in_progress' => 'warning',
                                'completed' => 'success',
                                default => 'secondary',
                            };
                        @endphp
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description ?: 'N/A' }}</td>
                            <td>
                                <span class="badge text-bg-{{ $badgeClass }}">
                                    {{ str_replace('_', ' ', $task->status) }}
                                </span>
                            </td>
                            <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                            <td class="text-end">
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
