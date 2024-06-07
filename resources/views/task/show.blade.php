@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task:</h1>

    <a href="{{ route('task.edit', $task) }}" class="edit">
        Edit
    </a>

    <form action="{{ route('task.destroy', $task) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>

    <div class="task">
        <div class="title">
            {{ $task->title }}
        </div>
        <div class="description">
            {{ $task->description }}
        </div>
        <div class="due-date">
            {{ $task->due_date }}
        </div>
        <div class="status {{ strtolower(str_replace(' ', '-', $task->status)) }}">
            {{ $task->status }}
        </div>
    </div>
</div>
@endsection