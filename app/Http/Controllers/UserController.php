<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Make sure this is included
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
public function update(Request $request, $id)       
{
   try {
       // Validate the input
       $request->validate([
           'position' => 'required'
       ]);

       // Find the user or fail
       $user = User::find($id);

       // Log the result of the find query
       Log::info('User found: ', ['user' => $user]);

       // If user is not found, return a 404 error with a message
       if (!$user) {
           return response()->json(['message' => 'User not found'], 404);
       }

       // Proceed with updating user
       $user->update([
           'position' => $request->input('position'),
       ]);

      return Redirect::to('/users')->with('success', 'User updated successfully');
   } catch (\Exception $e) {
       Log::error('Error updating user: ' . $e->getMessage());
       return response()->json(['message' => 'Error saving user', 'error' => $e->getMessage()], 500);          
   }
}

    public function destroy($id) {
        $user = User::findOrFail($id);            
        $user->delete();          
        return Redirect::to('/users')->with('success', 'User deleted successfully');         
    } // Delete user account
}