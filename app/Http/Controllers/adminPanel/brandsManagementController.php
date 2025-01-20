<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\BrandsModels;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class brandsManagementController extends Controller
{
    // Display a paginated list of brands
    public function index(Request $request)
    {
        // Fetch the search query from the request (brand name)
        $searchName = $request->get('name');

        // Start building the query for brands with eager loading of the category relationship
        $brandsQuery = BrandsModels::where('brandsId', 0)->with('category')->orderBy('id', 'DESC');

        // If a name is provided in the search, apply the filter
        if (!empty($searchName)) {
            $brandsQuery->where('name', 'like', '%' . $searchName . '%');
        }

        // Paginate the filtered or unfiltered results
        $brands = $brandsQuery->get();

        // Pass the data to the view
        return view('adminPanel.brandsAndModelsManagement.index', ['brands' => $brands]);
    }

    public function Testcreate()
    {
        return'sdfsdfsd';
    }


    // Show the form for creating a new brand
    public function create()
    {


        $subcategories = Category::where('mainId', '!=', 0)
            ->where('status', 1)
            ->select('id', 'name')
            ->get();
        return view('adminPanel.brandsAndModelsManagement.create', ['subcategories' => $subcategories]);
    }

    // Store a newly created brand in the database
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                "regex:/^[^\?\/\[\]{}\-,.<>:;'|!`~()&%$#@*\^]*$/",
                Rule::unique('brands_models')->where('sub_cat_id', $request['sub_cat_id'])
            ],
            'status' => 'required',
        ]);

        $sub_cat_url = Category::where('id', $request['sub_cat_id'] ?? (BrandsModels::where('id', $request['brandid'])->with('category')->first())->category->id)->first();

        // Generate URL based on name
        $url = strtolower($sub_cat_url->name." ".$validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        // Determine subcategory ID based on brand ID or selected subcategory
        $sub_cat_id = $request['brandid'] != 0 ? BrandsModels::where('id', $request['brandid'])->pluck('sub_cat_id')->first() : $request['sub_cat_id'];

        $brandsModels = new BrandsModels();
        $brandsModels->name = $validatedData['name'];
        $brandsModels->brandsId = $request['brandid'];
        $brandsModels->sub_cat_id = $sub_cat_id;
        $brandsModels->url = $url;
        $brandsModels->status = $validatedData['status'];

        // Save the brand
        $brandsModels->save();

        // Retrieve subcategories for form display
        $subcategories = Category::where('mainId', '!=', 0)
            ->where('status', 1)
            ->select('id', 'name')
            ->get();

        // Return appropriate view with success message
        if ($request['brandid'] == 0) {
            return view('adminPanel.brandsAndModelsManagement.create', ['subcategories' => $subcategories])->with('success', $validatedData['name'] . ' created successfully.');
        } else {
            $brand = BrandsModels::where('id', $request['brandid'])->select('id', 'url', 'name', 'status')->first();
            return view('adminPanel.brandsAndModelsManagement.create', ['brand' => $brand])->with('success', $validatedData['name'] . ' created successfully.');
        }
    }

    // Display the specified brand.
    public function view($url)
    {
        $data = BrandsModels::where('url', $url)->with('Category')->first();
        return view('adminPanel.brandsAndModelsManagement.view', ['data' => $data]);
    }

    // Show the form for editing the specified brand.
    public function update($url)
    {
        // Find the brand by URL for updating
        $data = BrandsModels::where('url', $url)->with('Category')->first();

        // Retrieve subcategories for form display
        $subcategories = Category::where('mainId', '!=', 0)
            ->where('status', 1)
            ->select('id', 'name')
            ->get();
        return view('adminPanel.brandsAndModelsManagement.update', ['data' => $data, 'subcategories' => $subcategories]);
    }

    // Update the specified brand in storage.
    public function updateBrand(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('brands_models')->where('sub_cat_id', $request['sub_cat_id'])->ignore($request->id)]
        ]);

        $sub_cat_url = Category::where('id', $request['sub_cat_id'] ?? (BrandsModels::where('id', $request['brandid'])->with('category')->first())->category->id)->first();

        // Generate URL based on name
        $url = strtolower($sub_cat_url->name." ".$validatedData['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        // Determine subcategory ID based on brand ID or selected subcategory
        $sub_cat_id = $request['brandid'] != 0 ? BrandsModels::where('id', $request['brandid'])->pluck('sub_cat_id')->first() : $request['sub_cat_id'];

        $brand = BrandsModels::findOrFail($request->id);
        $brand->name = $validatedData['name'];
        $brand->url = $url;
        $brand->brandsId = $request['brandid'];
        $brand->sub_cat_id = $sub_cat_id;
        $brand->status = $request->status;
        $brand->save();

        // Find the brand by ID for updating
        $data = BrandsModels::where('id', $request->id)->with('Category')->first();

        // Retrieve subcategories for form display
        $subcategories = Category::where('mainId', '!=', 0)
            ->where('status', 1)
            ->select('id', 'name')
            ->get();

        // Return appropriate view with success message
        if ($request['brandid'] == 0) {
            return view('adminPanel.brandsAndModelsManagement.update', ['data' => $data, 'subcategories' => $subcategories])->with('success', $validatedData['name'] . ' updated successfully.');
        } else {
            $brand = BrandsModels::where('id', $request['brandid'])->select('id', 'url', 'name', 'status')->first();
            return view('adminPanel.brandsAndModelsManagement.update', ['data' => $data, 'brand' => $brand])->with('success', $validatedData['name'] . ' updated successfully.');
        }
    }

    // Show the form for confirming the deletion of the specified brand.
    public function delete($url)
    {
        $data = BrandsModels::where('url', $url)->first();

        return view('adminPanel.brandsAndModelsManagement.delete', ['data' => $data]);
    }

    // Remove the specified brand from storage.
    public function deleteBrand($url)
    {
        $brand = BrandsModels::where('url', $url)->first();

        // Check if the brand exists
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }

        // Delete the brand
        $brand->delete();

        // Redirect with success message
        return redirect()->route('dashboard.configuration.brands-and-models')->with('success', 'Brand deleted successfully.');
    }
}
