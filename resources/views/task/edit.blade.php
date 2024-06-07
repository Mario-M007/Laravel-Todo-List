@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>
    <form action="{{ route('task.update', $task) }}" method="POST">
        @csrf
        <!-- override the post method -->
        @method('PUT')

        <label class="mt-3" for="title">Enter Task Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ $task->title }}">

        <label class="mt-3" for="description">Enter Task Description</label>
        <textarea class="form-control" name="description" id="description">{{ $task->description }}</textarea>

        <label class="mt-3" for="due_date">Due Date</label>
        <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $task->due_date }}">

        <label class="mt-3" for="status">Status</label>
        <select class="form-select" name="status" id="status">
            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In
                Progress</option>
            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed
            </option>
        </select>

        <div class="buttons mt-3">
            <a class="btn btn-secondary" href="{{ route('task.index') }}" class="cancel">
                Cancel
            </a>
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection