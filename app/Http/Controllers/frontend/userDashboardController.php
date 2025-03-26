<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class userDashboardController extends Controller
{
    public function index()
    {
        return view('newFrontend.user.dashboard');
    }

    public function my_ads()
    {
        $user = auth()->user(); 
        $activeAds = Ads::where('user_id', $user->id)->where('status', 1)->get();
        $pendingAds = Ads::where('user_id', $user->id)->whereIn('status', [0, 10])->get();
    
        return view('newFrontend.user.my_ads', compact('activeAds', 'pendingAds'));
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
            \Log::info('Request Data:', $request->all()); // Debugging
    
            if (!$request->has('district_id')) {
                return response()->json(['error' => 'Invalid request, district_id missing'], 400);
            }
    
            $cities = Cities::where('district_id', $request->district_id)->get();
    
            if ($cities->isEmpty()) {
                return response()->json(['error' => 'No cities found for this district'], 404);
            }
    
            return response()->json($cities);
        }
    
        return response()->json(['error' => 'Invalid request'], 400);
    }
    

    
    public function destroy($adsId)
    {
        $ad = Ads::findOrFail($adsId);  
        $ad->delete();

        return redirect()->route('user.my_ads')->with('success', 'Ad deleted successfully!');
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        //dd($request);
    
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'postCode' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'location' => 'nullable|exists:districts,id',
            'sublocation' => 'nullable|exists:cities,id',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company' => $request->company,
            'postCode' => $request->postCode,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'birthday' => $request->birthday,
            'location' => $request->location,
            'sub_location' => $request->sublocation,
        ];

        //dd($data);
    
        if ($request->hasFile('profileImage')) {
            // Delete old image if exists
            if ($user->profileImage) {
                Storage::delete('public/profile_images/' . $user->profileImage);
            }

            $originalName = $request->file('profileImage')->getClientOriginalName();
            $request->file('profileImage')->storeAs('public/profile_images', $originalName);

            $data['profileImage'] = $originalName;
        }
        
        $user->update($data);
    
        return redirect()->route('user.profile')->with('message', 'Profile updated successfully!');
    }
    

    public function logout()
    {
        return view('newFrontend.user.logout');
    }


}
