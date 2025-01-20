<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\AdsTypes;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class adsTypesManagementController extends Controller
{
    // Display all ads types
    public function index(Request $request)
    {
        // Fetch the search query from the request (package type name)
        $searchName = $request->get('name');
    
        // Start building the query for package types with eager loading of the category relationship
        $packageTypesQuery = AdsTypes::with('category')->orderBy('id', 'DESC');
    
        // If a name is provided in the search, apply the filter
        if (!empty($searchName)) {
            $packageTypesQuery->where('name', 'like', '%' . $searchName . '%');
        }
    
        // Get the filtered or unfiltered results
        $packageTypes = $packageTypesQuery->get();
    
        // Pass the data to the view
        return view('adminPanel.adsTypesManagement.index', compact('packageTypes'));
    }
    

    // Show form to create a new ads type
    function create(){
        $subcategories = Category::where('mainId', '!=', 0)
            ->where('status', 1)
            ->select('id', 'name')
            ->get();
        return view('adminPanel.adsTypesManagement.create',compact('subcategories'));
    }

    // Store a newly created ads type
    public function store(Request $request)
    {

        // Validate incoming data
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                "regex:/^[^\?\/\[\]{}\-,.<>:;'|!`~()&%$#@*\^]*$/",
                Rule::unique('table_ad_types')->where('catergoryId', $request['sub_cat_id'])
            ],
            'status' => 'required',
        ]);

        $sub_cat_url = Category::where('id',$request['sub_cat_id'])->first();

        // Generate URL based on name
        $url = strtolower($sub_cat_url->name." ".$validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);


        // Create a new ads type instance
        $adsType = new AdsTypes();
        $adsType->name = $validatedData['name'];
        $adsType->catergoryId = $request['sub_cat_id'];
        $adsType->url = $url;
        $adsType->status = $validatedData['status'];

        // Save the ads type
        $adsType->save();

        // Retrieve subcategories for view
        $subcategories = Category::where('mainId', '!=', 0)
            ->where('status', 1)
            ->select('id', 'name')
            ->paginate(6);

        // Redirect with success message
        return view('adminPanel.adsTypesManagement.create',['subcategories'=> $subcategories])->with('success', $validatedData['name'].' created successfully.');
    }

    // View details of a specific ads type
    public function view($url)
    {
        $data = AdsTypes::where('url', $url)->first();
        $data1=Category::where('id',$data->catergoryId)->select('mainId','name')->first();
        return view('adminPanel.adsTypesManagement.view',['data' => $data,'data1'=>$data1]);
    }

    // Show form to update a specific ads type
    public function update($url)
    {
        // Find the ads type by URL for updating
        $data = AdsTypes::where('url',$url )->first();
        $catId=Category::where('id',$data->catergoryId)->first();
        return view('adminPanel.adsTypesManagement.update',['data' => $data,'catId'=>$catId]);
    }

    // Update a specific ads type
    public function updateCategory(Request $request)
    {
        // Find the ads type by ID for updating
        $data = AdsTypes::find($request->id);
        $maincategory=[];

        // If the ads type has a main category, retrieve it
        if( $data->mainId != 0){
            $maincategory = Category::find( $data->mainId);
        }

        // If ads type not found, return with error message
        if (! $data) {
            return view('adminPanel.adsTypesManagement.update', ['data' => $data])
                ->with('unsuccess', 'Ads type not found.');
        }

        // Define validation rules
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                "regex:/^[^\?\/\[\]{}\-,.<>:;'|!`~()&%$#@*\^]*$/",
                Rule::unique('table_ad_types')->where('catergoryId', $request['sub_cat_id'])->ignore($request->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required'
        ];

        // Validate incoming data
        $validatedData = $request->validate($rules);


        $sub_cat_url = Category::where('id',$request['sub_cat_id'])->first();


        // Generate URL based on name
        $url = strtolower($sub_cat_url->name." ".$validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        // Update ads type data
        $data->name = $validatedData['name'];
        $data->url = $url;
        $data->status = $validatedData['status'];
        $data->save();

        // Redirect with success message
        return redirect()->route('dashboard.adsTypes.view', [$data->url])->with('success', 'Type updated successfully.');
    }

    // Show confirmation page to delete a specific ads type
    function delete($url){
        $category = AdsTypes::where('url', $url)->first();
        return view('adminPanel.adsTypesManagement.delete', ['category' => $category]);
    }

    // Delete a specific ads type
    function deleteType($url){
        // Find the ads type record with the given URL
        $deletedRecord = AdsTypes::where('url', $url)->first();
        $deletedRecord->delete();

        // Redirect with success message
        return redirect()->route('dashboard.adsTypes')->with('success', 'Category deleted successfully.');
    }
}
