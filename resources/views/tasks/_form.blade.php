@php
    $isEdit = isset($task);
    $selectedStatus = old('status', $task->status ?? 'pending');
@endphp

<form action="{{ $isEdit ? route('tasks.update', $task) : route('tasks.store') }}" method="POST" class="card shadow-sm">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="card-body">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $task->title ?? '') }}"
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                id="description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="4"
            >{{ old('description', $task->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select
                id="status"
                name="status"
                class="form-select @error('status') is-invalid @enderror"
                required
            >
                <option value="pending" @selected($selectedStatus === 'pending')>Pending</option>
                <option value="in_progress" @selected($selectedStatus === 'in_progress')>In Progress</option>
                <option value="completed" @selected($selectedStatus === 'completed')>Completed</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input
                type="date"
                id="due_date"
                name="due_date"
                class="form-control @error('due_date') is-invalid @enderror"
                value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
            >
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="card-footer bg-white">
        <button type="submit" class="btn btn-primary">
            {{ $isEdit ? 'Update Task' : 'Create Task' }}
        </button>
    </div>
</form>
