<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminManagementController extends Controller
{
    public function index(){
        // Fetch users with the role 'admin'
        $users = User::where('roles', ADMIN)->select('id', 'first_name', 'last_name', 'url', 'email', 'status')->paginate(10);

        // Pass the users data to the view
        return view('adminPanel.adminManagement.index', ['users' => $users]);
    }

    public function search(){
        // Fetch users with the role 'admin'
        $users = User::where('roles', ADMIN)->select('id', 'first_name', 'last_name', 'url', 'email', 'status')->paginate(10);

        // Pass the users data to the view
        return view('adminPanel.adminManagement.index', ['users' => $users]);
    }

    public function create()
    {
        // Fetch active users for potential assignment
        $users = User::where('status','1')->select('id', 'first_name', 'last_name')->get();

        return view('adminPanel.adminManagement.create',['users' => $users]);
    }

    public function view($id)
    {
        // Find the user by ID for viewing
        $user = User::find($id);
        return view('adminPanel.adminManagement.view',['user' => $user]);
    }

    public function store(Request $request)
    {
        // Fetch active users for potential assignment
        $users = User::where('status', '1')
            ->select('id', 'first_name', 'last_name')->get();

        // Validate incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|min:8',
        ]);

        // Generate a URL based on first and last name
        $url = strtolower($validatedData['first_name'] . '-' . $validatedData['last_name']);
        $url = preg_replace('/[^a-z0-9\-]/', '', $url);
        $url = preg_replace('/-+/', '-', $url);

        // Create a new user
        $user = new User();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->phone_number = $validatedData['number'];
        $user->roles = $request['role'];
        $user->url = $url;
        $user->status = '1';
        $user->password = Hash::make($validatedData['password']);

        $user->save();

        return view('adminPanel.adminManagement.create',['users' => $users])->with('usersuccess', $request['role'].' created successfully.');
    }

    public function giveAccess(Request $request)
    {
        // Find the user by ID
        $user = User::where('id', $request->user)->first();

        // Fetch active users for potential assignment
        $users = User::where('status', '1')
            ->select('id', 'first_name', 'last_name')->get();

        // Update user role if found
        if ($user) {
            $user->roles = $request->role;
            $user->save();
            return view('adminPanel.adminManagement.create',['users' => $users])->with('success', 'Role updated successfully.');
        } else {
            return view('adminPanel.adminManagement.create',['users' => $users])->with('unsuccess', 'Role has Not Found.');
        }
    }

    public function update($id)
    {
        // Find the user by ID for updating
        $user = User::find($id);
        return view('adminPanel.adminManagement.update',['user' => $user]);
    }

    public function updateUser(Request $request)
    {
        // Find the user by ID for updating
        $user = User::find($request->user);

        // If user not found, return with error message
        if (!$user) {
            return view('adminPanel.adminManagement.update',['user' => $user])->with('unsuccess', 'User not found.');
        }

        // Validate incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Generate a URL based on first and last name
        $url = strtolower($validatedData['first_name'] . '-' . $validatedData['last_name']);
        $url = preg_replace('/[^a-z0-9\-]/', '', $url);
        $url = preg_replace('/-+/', '-', $url);

        // Update user information
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->url = $url;
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->save();

        return view('adminPanel.adminManagement.update',['user' => $user])->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        // Find the user by ID for deletion
        $user = User::find($id);
        return view('adminPanel.adminManagement.delete',['user' => $user]);
    }

    public function deleteUser($id)
    {
        // Find the user by ID for deletion
        $user = User::find($id);

        // If user not found, redirect back with error message
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Delete user
        $user->delete();

        return redirect()->route('dashboard.admins')->with('success', 'User deleted successfully.');
    }
}
