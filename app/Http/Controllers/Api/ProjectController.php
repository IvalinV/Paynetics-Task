<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code = 0;
        $errors = [];

        try {
            $projects = Project::latest()->paginate(20);
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            $code = -1;
        }

        return response()->json([
            'code' => $code, //success, -1 error
            'data' => $projects,//data to be return
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
        $validated = $request->validate([
            'company' => 'required|max:20',
        ]);
        
        $code = 0;
        $errors = [];

        $project = new Project;

        $project->title = $request->get('title');
        $project->status = $request->get('status');
        $project->description = $request->get('description');
        $project->client_id = $request->get('client_id');
        $project->company = $request->get('company');
        $project->duration = $request->get('duration');
        
        try {
            $project->save();
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            $code = -1;
        }

        return response([
            'code' => $code, //success, -1 error
            'data' => $project,//data to be return
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $code = 0;
        $errors = [];

        $project->title = $request->get('title');
        $project->status = $request->get('status');
        $project->description = $request->get('description');
        $project->company = $request->get('company');
        $project->duration = $request->get('duration');

        try {
            $project->save();    
        } catch (\Exception $e) {
            $code = -1;
            $errors = $e->getMessage();
        }

        return response([
            'code' => $code, //success, -1 error
            'data' => $project,//data to be return
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
        $project = Project::findOrFail($id);
        
        $code = 0;
        $errors = [];

        try {
            $project->delete();
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
