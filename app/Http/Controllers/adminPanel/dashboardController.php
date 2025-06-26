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
        $adsDetails = DB::select("
            SELECT a.cat_id, COUNT(1) AS total, c.name
            FROM ads a
            JOIN categories c ON c.id = a.cat_id
            WHERE a.created_by_staff_id = ?
            GROUP BY a.cat_id, c.name
            ORDER BY a.cat_id ASC
        ", [$user->id]);
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
   
   /**
    * API endpoint to fetch all dashboard chart data
    * 
    * @return \Illuminate\Http\JsonResponse
    */
   public function apiCharts()
   {
        // Get users registration data
        $usersData = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
        
        // Get paid ads data
        $paidAdsData = Ads::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', date('Y'))
                    ->where('ads_package', '!=', 0)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
        
        // Get free ads data
        $freeAdsData = Ads::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', date('Y'))
                    ->where('ads_package', '=', 0)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
        
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        $usersChartData = $this->formatChartData($usersData, $months);
        $paidAdsChartData = $this->formatChartData($paidAdsData, $months);
        $freeAdsChartData = $this->formatChartData($freeAdsData, $months);
        
        return response()->json([
            'users' => $usersChartData,
            'paid_ads' => $paidAdsChartData,
            'free_ads' => $freeAdsChartData
        ]);
   }
   
   /**
    * Helper function to format chart data
    * 
    * @param \Illuminate\Support\Collection $data
    * @param array $months
    * @return array
    */
   private function formatChartData($data, $months)
   {
        $labels = [];
        $chartData = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i - 1];
            $count = $data->firstWhere('month', $i)?->count ?? 0;
            $chartData[] = $count;
        }
        
        return [
            'labels' => $labels,
            'data' => $chartData
        ];
   }
}
