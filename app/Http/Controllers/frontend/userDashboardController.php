<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Districts;
use Illuminate\Http\Request;

class userDashboardController extends Controller
{
    public function index()
    {
        return view('newFrontend.user.dashboard');
    }

    public function profile()
    {
        $user = auth()->user(); 
        $districts = Districts::all();
    
        return view('newFrontend.user.profile', compact('user', 'districts'));
    }
    

    public function getCities(Request $request)
    {
        if ($request->ajax()) {
            $cities = Cities::where('district_id', $request->district_id)->get();
            return response()->json($cities);
        }
    }
    

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'location' => 'nullable|exists:districts,id',
            'sublocation' => 'nullable|exists:cities,id',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'birthday' => $request->birthday,
            'location' => $request->location,
            'sub_location' => $request->sublocation,
        ]);

        return redirect()->route('user.profile')->with('message', 'Profile updated successfully!');
    }

}
