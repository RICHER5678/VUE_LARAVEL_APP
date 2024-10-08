<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
        ]);
     

        // Insert the data into the database
        Contact::create($validatedData);

        // Return a response
        return response()->json(['message' => 'Form submitted successfully!'], 201);
    }


    public function index()
    {
        // Fetch all contacts
        $contacts = Contact::all();

        // Return the data as a JSON response
        return response()->json($contacts);
    }

    //update contact
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        return response()->json(['message' => 'Contact updated successfully!']);
    }

      // Delete contact
      public function destroy($id)
      {
          $contact = Contact::findOrFail($id);
          $contact->delete();
  
          return response()->json(['message' => 'Contact deleted successfully!']);
      }

}
