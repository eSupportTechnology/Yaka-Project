<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class adsManagementController extends Controller
{

    public function index(Request $request)
    {
        $adCode = $request->get('code');
        $adsQuery = Ads::query();

        if (!empty($adCode)) {
            $adsQuery->where('adsId', 'like', '%' . $adCode . '%');
        }

        $adsData = $adsQuery->paginate(100);
        return view('newAdminDashboard.adsManagement.index', compact('adsData'));
    }


    public function status($status, $id)
    {
        $ads = Ads::where('adsId', $id)->firstOrFail(); 
        $ads->status = $status === 'disapprove' ? 0 : 1;
        $ads->save();
    
        return redirect()->route('dashboard.ads')->with('message', 'Ad status updated successfully');
    }
    

    public function getTopAds()
   {
    // Fetch only top ads that are approved (status = 1)
    $topAds = Ads::with('category', 'subcategory', 'main_location', 'sub_location')
                ->where('is_top_ad', 1) // Filtering only top ads
                ->where('status', 1) // Only approved ads
                ->orderBy('id', 'DESC')
                ->take(10) // Limit to 10 ads for the slideshow
                ->get();

    return response()->json($topAds);
    }

}
