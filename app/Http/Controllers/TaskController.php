<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $tasks = Task::orderBy('order')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Task::create(['title' => $request->title,'created_at' => now()
        ]);  
        
        return redirect('/');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['title' => 'required']);
        $task->update($request->only('title'));
        return redirect('/');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function toggle(Task $task)
    {
        $next = match ($task->status) {
            'not_started' => 'in_progress',
            'in_progress' => 'done',
            'done' => 'not_started',
            default => 'not_started',
        };

        $task->update(['status' => $next]);

        return redirect('/');
    }
    
    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Task::where('id', $id)->update(['order' => $index]);


        }

        return response()->json(['success' => true]);
    }

}
