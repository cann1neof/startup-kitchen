<?php

namespace App\Http\Controllers;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function all(Request $request)
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function current(Request $request)
    {
        $project = Project::find($request->$id);
        return response()->json($project);
    }

    public function create(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'title' => 'required',
            'text' => 'required',
            'contacts' => 'required',
            'themes' => 'required'
        ]);
        $project = Project::create([
            'user'=> $request->user,
            'title'=> $request->title,
            'text'=> $request->text,
            'contacts'=> $request->contacts,
            'themes'=>$request->themes
        ]);
        return response(['id' => $project->id], 201);
    }

    public function search(Request $request){
        $request->validate([
            'q' => 'required'
        ]);
        $projects = Project::where('title', 'LIKE', '%'.$request->q.'%')->get();

        return response()->json($projects);

    }
}
