@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-1" href="{{ route('task.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
            viewBox="0 0 16 16">
            <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
            </path>
        </svg>
        New Task
    </a>

    <!-- Filter and Sort Form -->
    <form method="GET" action="{{ route('task.index') }}" class="mt-3 mb-3">
        <div class="mt-1">
            <label for="status">Filter by Status</label>
            <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress
                </option>
                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mt-3">
            <label for="due_date">Filter by Due Date</label>
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

        <div class="mt-3">
            <label for="sort_by">Sort By</label>
            <select name="sort_by" id="sort_by" class="form-select" onchange="this.form.submit()">
                <option value="">None</option>
                <option value="due_date" {{ request('sort_by') == 'due_date' ? 'selected' : '' }}>Due Date</option>
                <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
            </select>
        </div>

        <div class="mt-1">
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

                <div class="title">
                    {{ $task->title }}
                </div>

                <div class="description">
                    {{ Str::words($task->description, 2) }}
                </div>

                <div class="due-date">
                    {{ $task->due_date != null ? __('Due: ') . $task->due_date : ''}}
                </div>

                <div class="status {{ strtolower(str_replace(' ', '-', $task->status)) }}">
                    {{ $task->status }}
                </div>

                <div class="task-action-buttons">
                    <a class="btn" href="{{ route('task.show', $task) }}" class="view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                        </svg>
                    </a>
                    <a class="btn" href="{{ route('task.edit', $task) }}" class="edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                    </a>
                    <form action="{{ route('task.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash"
                                viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>
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