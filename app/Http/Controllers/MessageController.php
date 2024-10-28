<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\{User,Department,Group,Organisation};


class MessageController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // Fetch all groups
           $message = Message::all();
        //    for fetching the users names from the users table(foreign ID)
        //    $message= Message::with('user')->get();
           // for fetching the departments fromt the departments table
           $message= Message::with('department')->get();
           //for getting the groups from the groups table
           $message = Message::with('group')->get();
           
           

           return response()->json($message);
    }


    public function store(Request $request)
    {
           // Validate the form data
           $validatedData = $request->validate([
            'message_content' => 'required',
            'sender_id' => 'required',
            'department_id' => 'required',
            'group_id' => 'required',
            // 'user_id' => 'required'
           
        ]);
     

        // Insert the data into the database
        Message::create($validatedData);
    
        // Return a response
        return response()->json(['message' => 'Message sent Successfully!'], 201);
    }



    public function update(Request $request,  $id)
    {
        $message = Message::findOrFail($id);
        $message->message_content = $request->message_content;
        $message->user_id = $request->user_id;
        $message->department_id = $request->department_id;
        $message->group_id = $request->group_id;
        $message->save();

        return response()->json(['message' => 'Message updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully!']);
    }
}
