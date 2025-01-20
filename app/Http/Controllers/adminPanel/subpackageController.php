<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageType;
use Illuminate\Http\Request;

class subpackageController extends Controller
{
    function index($url){
        $package=Package::where('url',$url)->first();
        $sub=PackageType::where('package_id',$package->id)->get();
        return view('adminPanel.packageManagement.subpackages',compact(['sub','package']));
    }
    public function update($url)
    {
        // Retrieve package data
        $pack = Package::where('url', $url)->first();


        return view('adminPanel.packageManagement.updatePackage', ['pack' => $pack]);
    }
    public function create($url)
    {
        // Retrieve main package information
        $maincategory = Package::where('url', $url)->select('id', 'url')->first();
        return view('adminPanel.packageManagement.createSubPackage', ['maincategory' => $maincategory]);
    }
    public function store(Request $request)
    {
        // Validate incoming data
        // $pack = Package::where('url', $url)->select('id', 'url')->first();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'duration'=>'required',
            'price'=>'required',
            'status' => 'required' // Assuming status is required for the category
        ]);

        // Determine image path based on whether it's a subcategory or not


        // Move uploaded image to storage


        // Generate a URL based on category name
        $url = strtolower($validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        // Create a new category instance

        $category = new PackageType();

        if(isset($request->mainid)){
            $category->package_id = $request->mainid;
        }

        //$category->package_id=$pack->id;
        $category->url=$url;
        $category->name = $validatedData['name'];
        $category->duration=$validatedData['duration'];
        $category->price=$validatedData['price'];

        $category->status = $validatedData['status'];


        // Save the category
        $category->save();

        // Redirect based on whether it's a subcategory or not
        if(isset($request->mainid)){
            $maincategory = Package::where('id',$request->mainid )->select('id','url')->first();
            return redirect()->route('dashboard.package.create', ['url' => $maincategory->url])
                ->with('success', 'Your success message here.');
        }else{
            return view('adminPanel.packageManagement.createNewPackage')->with('success', $validatedData['name'].' created successfully.');
        }

    }
    public function view($url)
    {
        // Retrieve subcategory information
        $category = PackageType::where('url', $url)->first();

        // Retrieve main category information
        $maincategory = Package::where('id', $category->package_id)->select('id', 'url')->first();

        return view('adminPanel.packageManagement.viewSubPackage', ['category' => $category, 'maincategory' => $maincategory]);
    }
    public function updatee($url)
    {
        // Retrieve subcategory information
        $category = PackageType::where('url', $url)->first();

        // Retrieve main category information
        $maincategory = Package::where('id', $category->package_id)->select('id', 'url')->first();

        return view('adminPanel.packageManagement.updateSubPackage', ['category' => $category, 'maincategory' => $maincategory]);
    }
    public function updateSubPackage(Request $request )
    {
        // Find the category by ID for updating
        $category = PackageType::find($request->id);
        $maincategory=[];

        // If the category has a main category, retrieve it
        if($category->package_id != 0){
            $maincategory = PackageType::find($category->mainId);
        }

        // If category not found, return with error message
        if (!$category) {
            return view('adminPanel.categoryManagement.update', ['category' => $category])
                ->with('unsuccess', 'Category not found.');
        }

        // Define validation rules
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'duration' => 'required|string|max:255',
            'price' => 'required|string|max:255',
        ];

        // Check if category name is changing and add validation rule accordingly
        if ($category->name != $request->name) {
            $rules['name'] = 'required|string|max:255|unique:package_typess,name';

        }

        // Validate incoming data
        $validatedData = $request->validate($rules);




        // Generate a URL based on the category name
        $url = strtolower($validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        // Update category data
        $category->name = $validatedData['name'] ?? $category->name;
        $category->url = $url;
        $category->duration = $validatedData['duration'] ;
        $category->price = $validatedData['price'] ;
        $category->status = $validatedData['status'];

        $category->save();

        return view('adminPanel.packageManagement.updateSubPackage', ['category' => $category ,'maincategory' => $maincategory ])->with('success', 'Category updated successfully.');
    }
    public function delete($url)
    {
        // Find the category by URL for deletion
        $category = PackageType::where('url',$url )->first();
        return view('adminPanel.packageManagement.deleteSubPackage',['category' => $category]);
    }
    function deleteSubPackage($url){
        $category =PackageType::where('url',$url )->first();

        $maincategory=[];

        // If the category has a main category, retrieve it
        if($category->package_id != 0){
            $maincategory = PackageType::find($category->id);

        }

        // If category not found, redirect back with error message
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Delete category
        $category->delete();

        // Redirect based on whether it's a subcategory or not
        if($category->package_id != 1){
            $maincategory = PackageType::find($category->id);

            return redirect()->route('dashboard.packages')->with('success', 'Category deleted successfully.');
        }else{
            return redirect()->route('dashboard.packages')->with('success', 'Category deleted successfully.');
        }

    }

}
