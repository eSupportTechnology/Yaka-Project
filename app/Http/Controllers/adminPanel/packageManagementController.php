<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\BannerPackage;
use Illuminate\Http\Request;

class packageManagementController extends Controller
{
    public function index()
    {
        $packTypes = Package::paginate(6);
        return view('newAdminDashboard.packageManagement.index', ['packTypes' => $packTypes]);
    }
// Show the form for creating a new categoryfindOrFail($student_id)
    public function create()
    {
        return view('newAdminDashboard.packageManagement.createNewPackage');
    }
// Store a newly created category in storage
    public function store(Request $request)
    {
// Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:table_package,name',
            'status' => 'required' // Assuming status is required for the category
        ]);



// Generate a URL based on category name
        $url = strtolower($validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

// Create a new category instance
        $category = new Package();
        $category->name = $validatedData['name'];
        if(isset($request->mainid)){
            $category->mainId = $request->mainid;
        }


        $category->url = $url;
        $category->status = $validatedData['status'];

// Save the category
        $category->save();

// Redirect based on whether it's a subcategory or not
        if(isset($request->mainid)){
            $maincategory = Package::where('id',$request->mainid )->select('id','url')->first();
            return redirect()->route('dashboard.sub-categories.create', ['url' => $maincategory->url])
                ->with('success', 'Your success message here.');
        }else{
            return view('newAdminDashboard.packageManagement.createNewPackage')->with('success', $validatedData['name'].' created successfully.');
        }
    }
// Display the specified category
    public function view($url)
    {
        $packTypes = Package::where('url',$url )->first();

        return view('newAdminDashboard.packageManagement.viewpackage',['packTypes' => $packTypes]);
    }
// Update the specified category in storage
    public function updatePackage(Request $request,$url)
    {
        $pack=Package::where('url',$url)->first();

// Find the category by ID for updating
        $category = Package::find($pack->id);
        $maincategory=[];

// If the category has a main category, retrieve it

// If category not found, return with error message



// Define validation rules
        $rules = [
            'name'=>'required',
            'status' => 'required'
        ];
// Check if category name is changing and add validation rule accordingly


// Validate incoming data
        $validatedData = $request->validate($rules);

// Update category image if a new one is provided

// Generate a URL based on the category name
       if(isset($validatedData['name'])){
        $url = strtolower($validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);
       }

// Update category data
        $pack->name = $validatedData['name'] ?? $pack->name;
        $pack->url = $url ?? $pack->url;
        $pack->status = $validatedData['status'];

        $pack->save();

        return view('newAdminDashboard.packageManagement.updatePackage', ['pack'=>$pack])->with('success', 'Category updated successfully.');
    }
    public function update($url)
    {
// Find the category by URL for updating
        $pack = Package::where('url',$url )->first();
        return view('newAdminDashboard.packageManagement.updatePackage',['pack' => $pack]);
    }
// Show the confirmation form for deleting the specified category
    public function delete($url)
    {
// Find the category by URL for deletion
        $category = Package::where('url',$url )->first();
        return view('newAdminDashboard.packageManagement.deletepackage',['category' => $category]);
    }
    public function deleteCategory($url)
    {
// Find the category by URL for deletion
        $category =Package::where('url',$url )->first();
        $maincategory=[];

// If the category has a main category, retrieve it
        if($category->mainId != 0){
            $maincategory = Package::find($category->mainId);
        }

// If category not found, redirect back with error message
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

// Delete category
        $category->delete();

// Redirect based on whether it's a subcategory or not
        if($category->mainId != 0){
            $maincategory = Package::find($category->mainId);
            return redirect()->route('dashboard.sub-categories',[$maincategory->url])->with('success', 'Category deleted successfully.');
        }else{
            return redirect()->route('dashboard.packages')->with('success', 'Category deleted successfully.');
        }

    }

    /**
     * Create banner package
     */
    public function bannerPackageCreate()
    {
        return view('newAdminDashboard.packageManagement.createNewBannerPackage');
    }

    public function storeBannerPackage(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:banner_packages,name',
            'status' => 'required',
            'no_of_days' => 'required',
        ]);
        $package = BannerPackage::create([
            'name' => $request->name,
            'status' => $request->status,
            'no_of_days' => $request->no_of_days,
        ]);
        return view('newAdminDashboard.packageManagement.createNewBannerPackage')->with('success', $validatedData['name'].' created successfully.');
    }

    /**
     *Banner Packge update view
     */
    public function updateBannerPackageView($id)
    {
        $pack = BannerPackage::where('id',$id )->first();
        return view('newAdminDashboard.packageManagement.updateBannerPackage',['pack' => $pack]);
    }

    /**
     * Banner package update
     */
    public function updateBannerPackage(Request $request,$id)
    {

        $rules = [
            'name'=>'required',
            'status' => 'required',
            'no_of_days' => 'required'
        ];
        $validatedData = $request->validate($rules);

        $pack = BannerPackage::where('id',$id)->first();
        $pack->name = $validatedData['name'] ?? $pack->name;
        $pack->no_of_days =$validatedData['no_of_days'] ?? $pack->no_of_days;
        $pack->status = $validatedData['status'];

        $pack->save();

        return view('newAdminDashboard.packageManagement.updateBannerPackage', ['pack'=>$pack])->with('success', 'Banner PackagedeleteCategory updated successfully.');
    }

    public function deleteBannerPackage($id)
    {
        $category = BannerPackage::where('id',$id )->first();
        return view('newAdminDashboard.packageManagement.deleteBannerpackage',['category' => $category]);
    }

    public function deleteBannerPack($id)
    {
        $pack = BannerPackage::where('id',$id )->first();

        if (!$pack) {
            return redirect()->back()->with('error', 'Category not found.');
        }
        $pack->delete();
        return redirect()->route('dashboard.banner-packages')->with('success', 'Banner Package deleted successfully.');

    }

}
