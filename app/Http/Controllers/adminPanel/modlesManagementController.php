<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\BrandsModels;
use App\Models\Category;
use Illuminate\Http\Request;

class modlesManagementController extends Controller
{
    public function index($url)
    {

        $brand = BrandsModels::where('url', $url)->select('id', 'url', 'name', 'status')->first();

        $models = BrandsModels::where('brandsId', $brand->id)->select('id', 'url', 'name', 'status')->paginate(6);

        return view('newAdminDashboard.brandsAndModelsManagement.models', ['brand' => $brand, 'models' => $models]);
    }

    public function create($url)
    {
        // Retrieve main category information
        $brand = BrandsModels::where('url', $url)->select('id', 'url')->first();
        return view('newAdminDashboard.brandsAndModelsManagement.create', ['brand' => $brand]);
    }


    public function view($url)
    {
        $data = BrandsModels::where('url', $url)->with('Category')->first();
        // Retrieve main category information
        $brand = BrandsModels::where('id', $data->brandsId)->select('id', 'url')->first();

        return view('newAdminDashboard.brandsAndModelsManagement.view', ['data' => $data, 'brand' => $brand]);

    }

    public function update($url)
    {
        // Retrieve subcategory information
        $data = BrandsModels::where('url', $url)->first();

        // Retrieve main category information
        $brand = BrandsModels::where('id', $data->brandsId)->select('id', 'url')->first();

        return view('newAdminDashboard.brandsAndModelsManagement.update', ['data' => $data, 'brand' => $brand]);
    }

}
