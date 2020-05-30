<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Project;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function create(Request $request)
    {
        $contact = new Contact;
        $contact.$project_id = $request->$project_id;
        $contact.$contactType = $request->$contactType;
        $contact.$contactValue = $request->$contactValue;
        $contact->save();
        // $request->project()->contacts()->create([
        //     'contactType' => $request->input('contactType'),
        //     'contactValue' => $request->input('contactValue')
        // ]);

        return response()->json(['status' => 'ok']);
    }

    public function getAll(Request $request)
    {
        $contacts = $request->project()->contacts()->get();
        return response()->json($contacts);
    }

}
