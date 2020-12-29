<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(20);
        
        $code = 0;
        $errors = [];
        
        return response([
            'code' => $code, //success, -1 error
            'data' => $tasks,//data to be return
            'еrrors' => $errors // if any
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;

        $task->title = $request->get('title');
        $task->status = $request->get('status');
        $task->description = $request->get('description');
        $task->duration = $request->get('duration');

        $code = 0;
        $errors = [];

        try {
            $task->save();
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            $code = -1;
        }
        
        return response([
            'code' => $code, //success, -1 error
            'data' => $task,//data to be return
            'еrrors' => $errors // if any
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $code = 0;
        $errors = [];
        
        try {
            $task = Task::findorFail($id);
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            $code = -1;
        }

        return response([
            'code' => $code, //success, -1 error
            'data' => $task,//data to be return
            'еrrors' => $errors // if any
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $code = 0;
        $errors = [];
        
        try {
            $task = Task::findorFail($id);
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            $code = -1;
        }

        return response([
            'code' => $code, //success, -1 error
            'data' => $task,//data to be return
            'еrrors' => $errors // if any
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $task)
    {
        $task = Task::find($task);
        
        $task->title = $request->get('title');
        $task->status = $request->get('status');
        $task->description = $request->get('description');
        $task->project_id = $request->get('project_id');
        $task->duration = $request->get('duration');

        $code = 0;
        $errors = [];
        
        try {
            $task->save();
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            $code = -1;
        }

        return response([
            'code' => $code, //success, -1 error
            'data' => $task,//data to be return
            'еrrors' => $errors // if any
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $code = 0;
        $errors = [];
        
        $task = Task::find($id);

        try {
            $task->delete();
        } catch (\Throwable $e) {
            $errors = $e->getMessage();
            $code = -1;
        }

        return response([
            'code' => $code, //success, -1 error
            'data' => [],//data to be return
            'еrrors' => $errors // if any
        ], 200);
    }
}
