<?php

namespace App\Http\Controllers\adminPanel;

use App\Models\Ads;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
   public function index()
   {
        $user = auth()->user();
        $userAds = Ads::where('created_by_staff_id', $user->id)->get();
        $totalAds = $userAds->count();
        $adsDetails = DB::select("select a.cat_id, count(1) as total, c.name from ads a join categories c on c.id=a.cat_id where a.created_by_staff_id =$user->id group by a.cat_id order by a.cat_id ASC");
       return view('newAdminDashboard.Home', compact('totalAds', 'adsDetails'));
   }

   public function fetchChartData()
   {
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

        $labels = [];
        $data = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i - 1];
            $count = $users->firstWhere('month', $i)?->count ?? 0;
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
   }

   public function fetchChartDataPaidAd()
   {
        $users = Ads::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', date('Y'))
                    ->where('ads_package', '!=', 0)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

        $labels = [];
        $data = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i - 1];
            $count = $users->firstWhere('month', $i)?->count ?? 0;
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
   }

   public function fetchChartDataFreeAd()
   {
        $users = Ads::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', date('Y'))
                    ->where('ads_package', '=', 0)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

        $labels = [];
        $data = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i - 1];
            $count = $users->firstWhere('month', $i)?->count ?? 0;
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
   }
}
