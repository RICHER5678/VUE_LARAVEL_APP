<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Models\User;

class TemplateController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // Fetch all groups
           $template = Template::all();
        //    for fetching the templates names from the users table(foreign ID)
           $template = Template::with('user')->get();
           

           return response()->json($template);
    }


    public function store(Request $request)
    {
           // Validate the form data
           $validatedData = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'template_message' => 'required'
      
        ]);
     

        // Insert the data into the database
        Template::create($validatedData);
    
        // Return a response
        return response()->json(['message' => 'Template Created Successfully!'], 201);
    }



    public function update(Request $request,  $id)
    {
        $template = Template::findOrFail($id);
        $template->title = $request->title;
        $template->user_id = $request->user_id;
        $template->template_message = $request->template_message;
        $template->save();

        return response()->json(['message' => 'Template updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $template = Template::findOrFail($id);
        $template->delete();

        return response()->json(['message' => 'Template deleted successfully!']);
    }
}
