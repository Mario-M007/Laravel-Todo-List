<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()->orderBy('created_at', 'asc')->paginate(10);
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return the create.blade.php file in the task folder that is inside the views folder
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task_title' => ['required', 'string'],
            'task_description' => ['nullable', 'string'],
        ]);

        $data['title'] = $data['task_title'];
        $data['description'] = $data['task_description'];
        $data['user_id'] = 1;
        $task = Task::create($data);

        return to_route('task.show', $task)->with('message', 'Task was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'task_title' => ['required', 'string'],
            'task_description' => ['nullable', 'string'],
        ]);

        $data['title'] = $data['task_title'];
        $data['description'] = $data['task_description'];
        $task->update($data);

        return to_route('task.show', $task)->with('message', 'Task was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return to_route('task.index')->with('message', 'Task was deleted');
    }
}
