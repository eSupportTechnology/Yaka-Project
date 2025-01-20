<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class usersManagementController extends Controller
{
    // Method to display a paginated list of users
    public function index(Request $request)
    {
        // Get the search parameter, default to null if not present
        $search = $request->get('search');
    
        // Build the query
        $query = User::where('roles', USER);
    
        // If there's a search term, apply the search condition
        if (!empty($search)) {
            $query->where('phone_number', 'like', '%' . $search . '%');
        }
    
        // Paginate the results
        $users = $query->select('id', 'first_name', 'last_name', 'url', 'phone_number', 'status')->paginate(10);
    
        // Pass the users data to the view
        return view('adminPanel.usersManagement.index', ['users' => $users]);
    }
    

    // Method to view details of a specific user
    public function view($id)
    {
        $user = User::find($id);
        return view('adminPanel.usersManagement.view',['user' => $user]);
    }

    // Method to display form for updating user details
    public function update($id)
    {
        $user = User::find($id);
        return view('adminPanel.usersManagement.update',['user' => $user]);
    }

    // Method to handle updating user details
    public function updateUser(Request $request)
    {
        $user = User::find($request->user);

        if (!$user) {
            return view('adminPanel.usersManagement.update',['user' => $user])->with('unsuccess', 'User not found.');
        }

        // Validate the incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Generate a URL based on the first name and last name
        $url = strtolower($validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        // Update user details
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->url = $url;
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->save();

        return view('adminPanel.usersManagement.update',['user' => $user])->with('success', 'User updated successfully.');
    }

    // Method to display confirmation for deleting a user
    public function delete($id)
    {
        $user = User::find($id);
        return view('adminPanel.usersManagement.delete',['user' => $user]);
    }

    // Method to handle deleting a user
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Delete the user
        $user->delete();

        return redirect()->route('dashboard.users')->with('success', 'User deleted successfully.');
    }

}
