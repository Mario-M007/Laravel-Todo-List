<x-layout>
    <div class="task-container">
        <a href="{{ route('task.create') }}">
            New Task
        </a>
        @foreach ($tasks as $task)
            <div class="tasks">
                <div class="title">
                    {{ $task->title }}
                </div>
                <div class="description">
                    {{ Str::words($task->description, 30) }}
                </div>
                <div class="buttons">
                    <a href="{{ route('task.show', $task) }}" class="view">
                        View
                    </a>
                    <a href="{{ route('task.edit', $task) }}" class="edit">
                        Edit
                    </a>
                    <form action="{{ route('task.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>