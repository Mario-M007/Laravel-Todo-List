@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Create New Task</h1>
        <form action="{{ route('task.store') }}" method="post">
            @csrf

            <label class="mt-3" for="title">Enter Task Title</label>
            <input class="form-control" type="text" name="title" id="title">

            <label class="mt-3" for="description">Enter Task Description</label>
            <textarea class="form-control" name="description" id="description"></textarea>

            <label class="mt-3" for="due_date">Due Date</label>
            <input class="form-control" type="date" name="due_date" id="due_date">
            
            <div class="buttons mt-3">
                <a class="btn btn-secondary" href="{{ route('task.index') }}" class="cancel">
                    Cancel
                </a>
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
</div>
@endsection