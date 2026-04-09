@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Task</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    @include('tasks._form', ['task' => $task])
@endsection
