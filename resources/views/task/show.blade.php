<x-app-layout>
    <div class="task-container">
        <h1>Task:</h1>
        <a href="{{ route('task.edit', $task) }}" class="edit">
            Edit
        </a>
        <button class="delete">
            Delete
        </button>
        <div class="task">
            <div class="title">
                {{ $task->title }}
            </div>
            <div class="description">
                {{ $task->description }}
            </div>
        </div>
    </div>
</x-app-layout>