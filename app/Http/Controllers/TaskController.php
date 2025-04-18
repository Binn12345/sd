<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(Request $request)
{
    return $request->user()->tasks;
}

public function store(Request $request)
{
    return $request->user()->tasks()->create([
        'title' => $request->title,
    ]);
}

public function update(Request $request, Task $task)
{
    $task->update($request->only('title', 'completed'));
    return $task;
}

public function destroy(Task $task)
{
    $task->delete();
    return response()->noContent();
}
}
