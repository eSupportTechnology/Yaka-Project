<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Banners;
use App\Models\User;
use Illuminate\Http\Request;

class bannerManagementController extends Controller
{
    // Method to display a paginated list of users
    public function index(){

        $banners = Banners::paginate(10); // Adjust the number per page as needed
        return view('adminPanel.bannerManagement.index', compact('banners'));
    }

    // Method to view details of a specific user
    public function view($id)
    {
        $user = User::find($id);
        return view('adminPanel.bannerManagement.view',['user' => $user]);
    }

    public function create()
    {
        // dd('sadasd');
        // $user = User::find($id);
        return view('adminPanel.bannerManagement.create');
    }

    // public function createBanner(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'gif' => 'required|file|mimes:gif|max:2048',  // Ensures only GIFs up to 2MB are allowed
    //         'type' => 'required|integer'
    //     ]);
    
    //     // Check if the file was uploaded without any errors
    //     if ($request->hasFile('gif')) {
    //         $file = $request->file('gif');

    
    
    //         // Check for upload errors
    //         if ($file->isValid()) {


    //             // Store the file in the 'public/banners' directory and return the path
    //             $path = $file->store('banners', 'public');
    
    //             // Here, you could save the path and any additional details (like 'type') to the database if needed
    //            Banners::create(['path' => $path, 'type' => $request->type]);
    
    //             return redirect()->back()->with('success', 'Banner uploaded successfully!');
    //         } else {
    //             return redirect()->back()->with('error', 'File upload error: ' . $file->getErrorMessage());
    //         }
    //     }
    
    //     return redirect()->back()->with('error', 'No file was uploaded.');
    // }
    
    
    public function createBanner(Request $request)
    {
        // Validate the basic form input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required'
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Get image dimensions
            list($width, $height) = getimagesize($image);

            // Validate based on the selected type
            if ($request->input('type') == 0) { // Leaderboard
                if ($width != 1140 || $height != 180) {
                    return redirect()->back()->withErrors(['image' => 'Leaderboard banner size must be 1140x180 pixels']);
                }
            } elseif ($request->input('type') == 1) { // Skyscraper
                if ($width != 285 || $height != 500) {
                    return redirect()->back()->withErrors(['image' => 'Skyscraper banner size must be 285x500 pixels']);
                }
            }

            // Save the image in the 'public/banners' folder
            $image->move(public_path('banners'), $imageName);

            // Create a new banner record in the database
            Banners::create([
                'img' => $imageName,
                'type' => $request->input('type'),
            ]);
        }

        return redirect()->route('dashboard.banner')->with('success', 'Banner uploaded successfully!');
    }

    // Method to display form for updating user details
    public function update($id)
    {
        $banner = Banners::find($id);
        return view('adminPanel.bannerManagement.update',['banner' => $banner]);
    }

    // Method to handle updating user details
    public function updatebanner(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:0,1',
        ]);

        $banner = Banners::findOrFail($id);

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('banners'), $imageName);

            // Delete the old image if exists
            if (file_exists(public_path('banners/' . $banner->img))) {
                unlink(public_path('banners/' . $banner->img));
            }

            $banner->img = $imageName;
        }

        // Update the banner type
        $banner->type = $request->input('type');
        $banner->save();

        return redirect()->route('dashboard.banner')->with('success', 'Banner updated successfully!');
    }
    

    public function delete($id)
    {
        $banner = Banners::findOrFail($id);

        // Delete the banner image from the file system
        if (file_exists(public_path('banners/' . $banner->img))) {
            unlink(public_path('banners/' . $banner->img));
        }

        // Delete the banner from the database
        $banner->delete();

        return redirect()->route('dashboard.banner')->with('success', 'Banner deleted successfully!');
    }

}
