<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesManagementController extends Controller
{
    // Display a paginated list of categories
    public function index()
    {
        $categories = Category::where('mainId', 0)->orderBy('id', 'DESC')->paginate(6);
        return view('adminPanel.categoryManagement.index', ['categories' => $categories]);
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('adminPanel.categoryManagement.create');
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required' // Assuming status is required for the category
        ]);

        // Determine image path based on whether it's a subcategory or not
        $imagePath = isset($request->mainid) ? 'images/SubCategory' : 'images/Category';

        $Freaddcount = $request->free_add_count;

        // Move uploaded image to storage
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path($imagePath), $imageName);



        // Create a new category instance
        $category = new Category();

        $category->name = $validatedData['name'];
        if (isset($request->mainid)) {
            $category->mainId = $request->mainid;
        }

        if (!isset($request->mainid)) {
            $category->free_add_count = $Freaddcount;
        }

        $category->image = $imageName;
        $category->url = $category->createUrl($validatedData['name']);
        $category->status = $validatedData['status'];

        // Save the category
        $category->save();

        // Redirect based on whether it's a subcategory or not
        if (isset($request->mainid)) {
            $maincategory = Category::where('id', $request->mainid)->select('id', 'url')->first();
            return redirect()->route('dashboard.sub-categories.create', ['url' => $maincategory->url])
                ->with('success', 'Your success message here.');
        } else {
            return view('adminPanel.categoryManagement.create')->with('success', $validatedData['name'].' created successfully.');
        }
    }

    // Display the specified category
    public function view($url)
    {
        $category = Category::where('url', $url)->first();
        return view('adminPanel.categoryManagement.view', ['category' => $category]);
    }

    // Show the form for editing the specified category
    public function update($url)
    {
        // Find the category by URL for updating
        $category = Category::where('url', $url)->first();
        return view('adminPanel.categoryManagement.update', ['category' => $category]);
    }

    // Update the specified category in storage
    public function updateCategory(Request $request)
    {
        // Find the category by ID for updating
        $category = Category::find($request->id);
        $maincategory = [];

        // If the category has a main category, retrieve it
        if ($category->mainId != 0) {
            $maincategory = Category::find($category->mainId);
        }

        // If category not found, return with error message
        if (!$category) {
            return view('adminPanel.categoryManagement.update', ['category' => $category])
                ->with('unsuccess', 'Category not found.');
        }

        // Define validation rules
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required'
        ];

        // Check if category name is changing and add validation rule accordingly
        if ($category->name != $request->name) {
            $rules['name'] = 'required|string|max:255';
        }

        // Validate incoming data
        $validatedData = $request->validate($rules);

        // Update category image if a new one is provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/Category'), $imageName);
            $category->image = $imageName;
        }

        $Freaddcount = $request->free_add_count;

        // Generate a URL based on the category name
        $url = strtolower($validatedData['name'] ?? $category->name);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

        // Update category data
        $category->name = $validatedData['name'] ?? $category->name;
        // $category->url = $url;

        if (!isset($request->mainid)) {
            $category->free_add_count = $Freaddcount;
        }

        $category->status = $validatedData['status'];

        $category->save();

        return view('adminPanel.categoryManagement.update', ['category' => $category, 'maincategory' => $maincategory])->with('success', 'Category updated successfully.');
    }

    // Show the confirmation form for deleting the specified category
    public function delete($url)
    {
        // Find the category by URL for deletion
        $category = Category::where('url', $url)->first();
        return view('adminPanel.categoryManagement.delete', ['category' => $category]);
    }

    // Remove the specified category from storage
    public function deleteCategory($url)
    {
        // Find the category by URL for deletion
        $category = Category::where('url', $url)->first();
        $maincategory = [];

        // If the category has a main category, retrieve it
        if ($category->mainId != 0) {
            $maincategory = Category::find($category->mainId);
        }

        // If category not found, redirect back with error message
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Delete category
        $category->delete();

        // Redirect based on whether it's a subcategory or not
        if ($category->mainId != 0) {
            $maincategory = Category::find($category->mainId);
            return redirect()->route('dashboard.sub-categories', [$maincategory->url])->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('dashboard.categories')->with('success', 'Category deleted successfully.');
        }
    }
}
