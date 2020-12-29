<?php

namespace App\Http\Controllers;

use App\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:8000/api/task/list');
        $tasks = json_decode($response, true)['data'];
        
        return view('tasks.index', ['tasks' => $tasks, 'title' => 'Tasks']); // !!!!
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create', ['title' => 'Tasks']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post('http://localhost:8000/api/task/store', $request->all());
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $response = Http::get('http://localhost:8000/api/task/show', $task);
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', ['title' => 'Edit', 'task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $task_id)
    {
        $task = Task::find($task_id);
        $response = Http::post('http://localhost:8000/api/task/update', $request->all(), $task);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $response = Http::post('http://localhost:8000/api/task/delete', $task);
        return $response;
    }
}
