<?php

namespace App\Http\Controllers;
use App\Project;
use Illuminate\Http\Request;

class FileUploadController extends Controller

{
    // function to store file in 'upload' folder
    public function fileStore($id, Request $request)
    {
        $upload_path = public_path('upload');
        $file_name = $request->file->getClientOriginalName();
        $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($upload_path, $generated_new_name);
        $project = Project::find($id);
        $project->$imgUrl = $upload_path;
        $project->save();
        return response()->json(['success' => 'You have successfully uploaded "' . $file_name . '"']);
    }
}
