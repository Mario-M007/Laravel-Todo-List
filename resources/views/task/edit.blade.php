@extends('layouts.app')

@section('content')
<div class="task-container">
    <div class="tasks">
        <h1>Edit Task</h1>
        <form action="{{ route('task.update', $task) }}" method="POST">
            @csrf
            <!-- override the post method -->
            @method('PUT')
            <label for="task_title">Enter Task</label>
            <input type="text" name="task_title" id="task_title" value="{{ $task->title }}">
            <label for="task_description">Enter Task Description</label>
            <textarea name="task_description" id="task_description">{{ $task->description }}</textarea>
            <div class="buttons">
                <a href="{{ route('task.index') }}" class="cancel">
                    Cancel
                </a>
                <input type="submit" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection