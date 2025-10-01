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
use Illuminate\Support\Facades\Log;
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
    try {
        echo "Step 1: Entered initPayment() method<br>";

        $user = auth()->user();
        echo "Step 2: Authenticated User ID = {$user->id}<br>";

        $price = (float) $request->price;
        echo "Step 3: Price = {$price}<br>";

        $invoiceId = "YKMB" . now()->format('ymdHis');
        echo "Step 4: Generated Invoice ID = {$invoiceId}<br>";

        $checkValue = IpgHashService::hash($price, $invoiceId);
        echo "Step 5: Generated Check Value = {$checkValue}<br>";

        PaymentInfo::create([
            'check_value' => $checkValue,
            'invoice_id'  => $invoiceId,
            'user_id'     => $user->id,
            'ad_data'     => json_encode($request->only(['price', 'promotion_voucher_cost', 'ads_per_month', 'valid_month'])),
            'payment_for' => 'membership',
        ]);
        echo "Step 6: PaymentInfo record created<br>";

        session([
            'checkValue' => $checkValue,
            'invoiceId' => $invoiceId,
            'membership_data' => $request->all()
        ]);
        echo "Step 7: Session variables stored<br>";

        echo "Step 8: Returning membership-payment view<br>";
        return view('newFrontend.user.membership-payment', [
            'price' => $price,
            'invoiceId' => $invoiceId,
            'checkValue' => $checkValue,
            'membershipData' => $request->all()
        ]);

    } catch (\Throwable $e) {
        echo "Step 9: Exception occurred → " . $e->getMessage() . "<br>";

        // Log the error for debugging
        Log::error('Payment initialization failed: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('error', 'Something went wrong while initializing the payment. Please try again.');
    }
}


}
