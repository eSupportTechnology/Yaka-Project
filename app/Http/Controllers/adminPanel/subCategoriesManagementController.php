<?php

namespace App\Http\Controllers\adminPanel;

use App\Action\Category\GetSubCategories;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class subCategoriesManagementController extends Controller
{
    /**
     * Display a listing of the subcategories.
     *
     * @param string $url
     * @return \Illuminate\Contracts\View\View
     */
    public function index($url)
    {
        // Retrieve main category information
        $maincategory = Category::where('url', $url)->select('id', 'url', 'name', 'status')->first();

        // Retrieve subcategories related to the main category
        $subcategories = Category::where('mainId', $maincategory->id)->select('id', 'url', 'name', 'status')->paginate(6);

        return view('newAdminDashboard.categoryManagement.subCategory', ['maincategory' => $maincategory, 'subcategories' => $subcategories]);
    }

    /**
     * Show the form for creating a new subcategory.
     *
     * @param string $url
     * @return \Illuminate\Contracts\View\View
     */
    public function create($url)
    {
        // Retrieve main category information
        $maincategory = Category::where('url', $url)->select('id', 'url')->first();

        return view('newAdminDashboard.categoryManagement.create', ['maincategory' => $maincategory]);
    }

    /**
     * Display the specified subcategory.
     *
     * @param string $url
     * @return \Illuminate\Contracts\View\View
     */
    public function view($url)
    {
        // Retrieve subcategory information
        $category = Category::where('url', $url)->first();

        // Retrieve main category information
        $maincategory = Category::where('id', $category->mainId)->select('id', 'url')->first();

        return view('newAdminDashboard.categoryManagement.view', ['category' => $category, 'maincategory' => $maincategory]);
    }

    /**
     * Show the form for editing the specified subcategory.
     *
     * @param string $url
     * @return \Illuminate\Contracts\View\View
     */
    public function update($url)
    {
        // Retrieve subcategory information
        $category = Category::where('url', $url)->first();

        // Retrieve main category information
        $maincategory = Category::where('id', $category->mainId)->select('id', 'url')->first();

        return view('newAdminDashboard.categoryManagement.update', ['category' => $category, 'maincategory' => $maincategory]);
    }

    /**
     * Show the confirmation form for deleting the specified subcategory.
     *
     * @param string $url
     * @return \Illuminate\Contracts\View\View
     */
    public function delete($url)
    {
        // Retrieve subcategory information
        $category = Category::where('url', $url)->first();

        // Retrieve main category information
        $maincategory = Category::where('id', $category->mainId)->select('id', 'url')->first();

        return view('newAdminDashboard.categoryManagement.delete', ['category' => $category, 'maincategory' => $maincategory]);
    }

    public function getSubCategoriesByCategoryId($categoryId, GetSubCategories $getSubCategories): JsonResponse
    {
        $response = $getSubCategories($categoryId);
        return response()->json($response);
    }
}
