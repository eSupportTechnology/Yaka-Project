<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $categories = Category::where('mainId', 0)
            ->where('status', 1)
            ->withCount(['ads' => function ($query) {
                $query->where('status', 1)
                    ->where(function ($q) {
                        $q->whereNull('package_expire_at')
                            ->orWhere('package_expire_at', '>=', now());
                    });
            }])
            ->get();

        $myMemberships = MembershipPackage::where('user_id', Auth::id())
            ->where('expiry_date', '>', now())
            ->get();

        return view('newFrontend.membership.index', compact('packages', 'myMemberships', 'categories'));
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
        'business_name' => 'required|string|max:255',
        'business_email' => 'required|email|max:255',
        'business_phone' => 'required|string|max:20',
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
    $membership = MembershipPackage::create([
        'user_id' => $user->id,
        'start_date' => $startDate,
        'expiry_date' => $expiryDate,
        'ads_per_month' => $request->ads_per_month,
        'voucher_code' => strtoupper(Str::random(6)),
        'price' => $request->price,
        'promotion_voucher_cost' => $request->promotion_voucher_cost,
        'valid_month' => $request->valid_month,
        'business_name' => $request->business_name,
        'business_email' => $request->business_email,
        'business_phone' => $request->business_phone,
    ]);

    // Redirect to initPayment with membership id
    return redirect()->route('membership.payment.init', ['membershipId' => $membership->id]);
}


    public function initPayment(Request $request)
{
    try {
        $user = auth()->user();
        $price = (float) $request->price;

        $invoiceId = "YKMB" . now()->format('ymdHis');

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
            'membership_data' => $request->all(),
            $invoiceId . 'add_data' => $request->only(['price', 'promotion_voucher_cost', 'ads_per_month', 'valid_month'])
        ]);

        return view('newFrontend.user.payment', [
            'price' => $price,
            'invoiceId' => $invoiceId,
            'checkValue' => $checkValue,
            'membershipData' => $request->all(),
            'gatewayUrl' => 'https://sandbox.payable.lk/ipg/v2'
        ]);
    } catch (\Throwable $e) {
        Log::error('Payment initialization failed: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('error', 'Something went wrong while initializing the payment. Please try again.');
    }
}

    public function getByCategory($id)
    {
        $plans = MembershipPlan::where('category_id', $id)->get();

        return response()->json($plans);
    }
}
