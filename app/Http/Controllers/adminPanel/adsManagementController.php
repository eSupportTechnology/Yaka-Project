<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class adsManagementController extends Controller
{
    // Method to display ads data
    public function index(Request $request)
    {
        // Fetch the search query from the request (ad code)
        $adCode = $request->get('code');

        // Start building the ads query with eager loading of related models
        $adsQuery = Ads::with('ads_vehicles', 'ads_electronics', 'ads_property', 'main_location', 'sub_location', 'category', 'subcategory')
                        ->where('status', '<', 10)
                        ->orderBy('id', 'DESC');

        // If an ad code is provided, apply a search filter
        if (!empty($adCode)) {
            $adsQuery->where('adsId', 'like', '%' . $adCode . '%');
        }

        // Paginate the fetched data
        $adsData = $adsQuery->paginate(100);

        // Pass the ads data to the view
        return view('adminPanel.adsManagement.index', ['adsData' => $adsData]);
    }


    // Method to update status of an ad
    public function status($status , $id)
    {
        // Find the ad by its ID
        $ads = Ads::find($id);

        // Update the status based on the provided status parameter
        $status == 'disapprove' ? $ads->status = 0 : $ads->status = 1 ;
        $ads->save();

        // Fetch ads data along with related models using eager loading
        $adsQuery = Ads::with('ads_vehicles','ads_electronics', 'main_location', 'sub_location', 'category', 'subcategory')
        ->where('status', '<',10)
        ->orderBy('id', 'DESC');

        // Paginate the fetched data
        $adsData = $adsQuery->paginate(9);

        // Pass the updated ads data to the view along with a success message
        return view('adminPanel.adsManagement.index', ['adsData' => $adsData])->with('message', 'User updated successfully');
    }


}
