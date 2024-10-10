<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // Fetch all departments
           $department = Department::all();
           //for fetching the organisation names from the organisation table(foreign ID)
           $department = Department::with('organisation')->get();

           // Return the data as a JSON response
           return response()->json($department);
    }


    public function store(Request $request)
    {
           // Validate the form data
           $validatedData = $request->validate([
            'name' => 'required',
            'organisation_id' => 'required'
      
        ]);
     

        // Insert the data into the database
        Department::create($validatedData);
    
        // Return a response
        return response()->json(['message' => 'Department Created Successfully!'], 201);
    }



    public function update(Request $request,  $id)
    {
        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->save();

        return response()->json(['message' => 'Department updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(['message' => 'Department deleted successfully!']);
    }
}
