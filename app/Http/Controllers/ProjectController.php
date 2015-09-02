<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'nama_project';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
            $data_project = Project::orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
        } else {
            $data_project = Project::orderBy($orderBy, $order)->paginate(15);
        }

        return view('project.index', compact('data_project', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateProjectRequest  $request
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();

        Project::create($input);

        return redirect('/project')->with('success', 'Sukses menambah project ' . $input['nama_project'] . '.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Project $project
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

        return redirect('/project')->with('success', 'Sukses memperbarui project ' . $input['nama_project'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Project $project
     * @return Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/project')->with('success', 'Sukses menghapus project ' . $project->nama_project . '.');
    }
}
