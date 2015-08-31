<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Http\Requests;
use App\Http\Request\CreateProjectRequest;
use App\Http\Request\UpdateProjectRequest;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Project $project
     * @return Response
     */
    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  App\Http\Request\UpdateProjectRequest
     * @param  App\Project $project
     * @return Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $input = $request->all();

        $project->fill($input)->save();

        return redirect('/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Project $project
     * @return Response
     */
    public function destroy($id)
    {
        $project->delete();

        return redirect('/project');
    }
}
