@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>
    <form action="{{ route('task.update', $task) }}" method="POST">
        @csrf
        <!-- override the post method -->
        @method('PUT')

        <label for="title">Enter Task</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ $task->title }}">

        <label for="description">Enter Task Description</label>
        <textarea class="form-control" name="description" id="description">{{ $task->description }}</textarea>

        <label for="due_date">Due Date</label>
        <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $task->due_date }}">

        <label for="status">Status</label>
        <select class="form-select" name="status" id="status">
            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In
                Progress</option>
            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed
            </option>
        </select>

        <div class="buttons">
            <a href="{{ route('task.index') }}" class="cancel">
                Cancel
            </a>
            <input type="submit" value="submit">
        </div>
    </form>
</div>
@endsection