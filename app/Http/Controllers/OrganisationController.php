<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all contacts
         $organisation = Organisation::all();

         // Return the data as a JSON response
         return response()->json($organisation);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Validate the form data
          $validatedData = $request->validate([
            'name' => 'required',

        ]);
     

        // Insert the data into the database
        Organisation::create($validatedData);

        // Return a response
        return response()->json(['message' => 'Organisation Created Successfully!'], 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $organisation = Organisation::findOrFail($id);
        $organisation->name = $request->name;
        $organisation->save();

        return response()->json(['message' => 'Organisation updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $organisation = Organisation::findOrFail($id);
        $organisation->delete();

        return response()->json(['message' => 'Organisation deleted successfully!']);
    }
}
