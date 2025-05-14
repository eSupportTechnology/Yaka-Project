<?php

namespace App\Http\Controllers\adminPanel;

use App\Models\Ads;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
   public function index()
   {
       return view('newAdminDashboard.Home');
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
