<x-layout>
    <div class="task-container">
        <div class="tasks">
            <h1>Create New Task</h1>
            <form action="{{ route('task.store') }}" method="post">
            @csrf
                <label for="task_title">Enter Task</label>
                <input type="text" name="task_title" id="task_title">
                <label for="task_description">Enter Task Description</label>
                <textarea name="task_description" id="task_description"></textarea>
                <div class="buttons">
                    <a href="{{ route('task.index')}}" class="cancel">
                        Cancel
                    </a>
                    <input type="submit" value="Submit" class="submit-btn">
                </div>
            </form>
        </div>
    </div>
</x-layout>