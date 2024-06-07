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
        $query = Task::where('user_id', request()->user()->id);

        // Filtering by status
        if (request()->has('status') && request()->status != '') {
            $query->where('status', request()->status);
        }

        // Filtering by due date
        if (request()->has('due_date') && request()->due_date != '') {
            $query->where('due_date', request()->due_date);
        }

        // Sorting
        if (request()->has('sort_by') && request()->sort_by != '') {
            $query->orderBy(request()->sort_by, request()->get('sort_order'));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $tasks = $query->paginate(15);

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
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        $data['user_id'] = $request->user()->id;
        $task = Task::create($data);

        return to_route('task.show', $task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

        if ($task->user_id != request()->user()->id) {
            // abort and show forbidden error msg
            abort(403);
        }
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task->user_id != request()->user()->id) {
            // abort and show forbidden error msg
            abort(403);
        }
        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id != request()->user()->id) {
            // abort and show forbidden error msg
            abort(403);
        }
        $data = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', 'string']
        ]);

        $task->update($data);

        return to_route('task.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id != request()->user()->id) {
            // abort and show forbidden error msg
            abort(403);
        }

        $task->delete();

        return to_route('task.index');
    }
}
