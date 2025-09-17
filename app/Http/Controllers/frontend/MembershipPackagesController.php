<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\MembershipPackage;
use App\Models\MembershipPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MembershipPackagesController extends Controller
{
    public function index()
    {
        $packages = MembershipPlan::all();
        $myMemberships = MembershipPackage::where('user_id', Auth::id())->get();
        return view('newFrontend.membership.index', compact('packages', 'myMemberships'));
    }

    public function create()
    {
        $users = User::all();
        return view('newAdminDashboard.membershipPackage.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Validate request (if needed)
        $request->validate([
            'price' => 'required|numeric',
            'promotion_voucher_cost' => 'nullable|numeric',
            'ads_per_month' => 'required|integer',
            'valid_month' => 'required|integer',
        ]);

        // Calculate dates
        $startDate = Carbon::now();
        $expiryDate = Carbon::now()->addMonths((int) $request->valid_month);

        // Create membership package
        $package = MembershipPackage::create([
            'user_id' => $user->id,
            'start_date' => $startDate,
            'expiry_date' => $expiryDate,
            'ads_per_month' => $request->ads_per_month,
            'voucher_code' => strtoupper(Str::random(6)),
            'price' => $request->price,
            'promotion_voucher_cost' => $request->promotion_voucher_cost,
            'valid_month' => $request->valid_month,
        ]);

        return redirect()->back()->with('success', 'Membership purchased successfully!');
    }

}
