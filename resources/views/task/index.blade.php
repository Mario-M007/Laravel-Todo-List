@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('task.create') }}">New Task</a>

    <!-- Filter and Sort Form -->
    <form method="GET" action="{{ route('task.index') }}" class="mb-3">
        <div class="">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress
                </option>
                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ request('due_date') }}"
                onchange="this.form.submit()">
            <input type="reset" class="btn btn-secondary mt-2" value="Reset Date" onclick="resetDateFilter()">
            <script>
                function resetDateFilter() {
                    document.getElementById('due_date').value = '';
                    document.getElementById('due_date').form.submit();
                }
            </script>
        </div>

        <div class="">
            <label for="sort_by">Sort By</label>
            <select name="sort_by" id="sort_by" class="form-select" onchange="this.form.submit()">
                <option value="">None</option>
                <option value="due_date" {{ request('sort_by') == 'due_date' ? 'selected' : '' }}>Due Date</option>
                <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
            </select>
        </div>

        <div class="">
            <label for="sort_order">Sort Order</label>
            <select name="sort_order" id="sort_order" class="form-select" onchange="this.form.submit()">
                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </div>
    </form>

    <div class="task-container">
        @foreach ($tasks as $task)
            <div class="task">
                <div class="title">{{ $task->title }}</div>
                <div class="description">{{ Str::words($task->description, 10) }}</div>
                <div class="due-date">{{ $task->due_date }}</div>
                <div class="status {{ strtolower(str_replace(' ', '-', $task->status)) }}">{{ $task->status }}</div>
                <div class="buttons">
                    <a href="{{ route('task.show', $task) }}" class="view">View</a>
                    <a href="{{ route('task.edit', $task) }}" class="edit">Edit</a>
                    <form action="{{ route('task.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <!-- generate paginated links -->
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</div>
@endsection