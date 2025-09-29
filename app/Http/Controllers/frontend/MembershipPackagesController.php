<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\MembershipPackage;
use App\Models\MembershipPlan;
use App\Models\PaymentInfo;
use App\Services\IpgHashService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MembershipPackagesController extends Controller
{
    public function index()
    {
        $packages = MembershipPlan::all();

        $myMemberships = MembershipPackage::where('user_id', Auth::id())
            ->where('expiry_date', '>', now())
            ->get();

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

        // Validate request
        $request->validate([
            'price' => 'required|numeric|min:0',
            'promotion_voucher_cost' => 'nullable|numeric|min:0',
            'ads_per_month' => 'required|integer|min:1',
            'valid_month' => 'required|integer|min:1',
        ]);

        // Check if user already has an active membership
        $activeMembership = MembershipPackage::where('user_id', $user->id)
            ->where('expiry_date', '>', now()) // not expired yet
            ->first();

        if ($activeMembership) {
            return redirect()->back()->with('error', 'You already have an active membership. You can purchase another after it expires.');
        }

        // Calculate dates
        $startDate = now();
        $expiryDate = now()->addMonths((int) $request->valid_month);

        // Create membership package
        MembershipPackage::create([
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

    public function initPayment(Request $request)
    {
        $user = auth()->user();
        $price = (float) $request->price;

        $invoiceId = "YKMB" . now()->format('YmdHis') . $user->id;
        $checkValue = IpgHashService::hash($price, $invoiceId);

        PaymentInfo::create([
            'check_value' => $checkValue,
            'invoice_id'  => $invoiceId,
            'user_id'     => $user->id,
            'ad_data'     => json_encode($request->only(['price', 'promotion_voucher_cost', 'ads_per_month', 'valid_month'])),
            'payment_for' => 'membership',
        ]);

        session([
            'checkValue' => $checkValue,
            'invoiceId' => $invoiceId,
            'membership_data' => $request->all()
        ]);

        return view('newFrontend.user.membership-payment', [
            'price' => $price,
            'invoiceId' => $invoiceId,
            'checkValue' => $checkValue,
            'membershipData' => $request->all()
        ]);
    }
}
