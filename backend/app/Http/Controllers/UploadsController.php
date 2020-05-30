<?php

namespace App\Http\Controllers;

use App\Project;
use App\Trais\Eloquent\Uplodable;
use App\Http\Requests\StoreAttachmentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UploadsController extends Controller
{ 
    public function uploadImage($id, StoreAttachmentRequest $request)
    {
        $proj = Project::find($id);
        $proj->imgUrl = $proj->uploadImage($request->image);
        $proj->save();
        return response(200);
    }
}