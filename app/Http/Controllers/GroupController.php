<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // Fetch all groups
           $group = Group::all();
           //for fetching the organisation names from the organisation table(foreign ID)
           $group = Group::with('organisation')->get();
           //for fetching the departments names from the departments table(foreign ID)
           $group = Group::with('department')->get();
           // Return the data as a JSON response
           return response()->json($group);
    }


    public function store(Request $request)
    {
           // Validate the form data
           $validatedData = $request->validate([
            'name' => 'required',
            'organisation_id' => 'required',
            'department_id' => 'required'
      
        ]);
     

        // Insert the data into the database
        Group::create($validatedData);
    
        // Return a response
        return response()->json(['message' => 'Group Created Successfully!'], 201);
    }



    public function update(Request $request,  $id)
    {
        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->save();

        return response()->json(['message' => 'Group updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return response()->json(['message' => 'Group deleted successfully!']);
    }
}
