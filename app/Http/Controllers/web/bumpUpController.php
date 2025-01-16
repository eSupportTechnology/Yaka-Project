<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\PackageType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class bumpUpController extends Controller
{
    public function index($id,$type='all')
    { app()->setlocale(Session::get('locale'));
        // Find the ad by its ID
        $ads = Ads::find($id);

        $plan = PackageType::with('package')->where('id',5)->where('status',1)->first();
        $amount = $plan->price;

        $user = User::with('sublocation')->find(Session::get('user')['id']);

        $customerFirstName = $user->first_name;
        $customerLastName = $user->last_name;
        $customerMobilePhone = $user->phone_number;
        $customerEmail = $user->email ?? 'test@gmail.com';
        $billingAddressCity = $user->sublocation->name_en ?? 'kandy';


        // Update the status based on the provided status parameter
        $ads->ads_package =  5;
        $ads->status = 10;
        $ads->bump_up_at =  Carbon::now();
        $ads->save();

        $query = Ads::with('ads_vehicles','ads_electronics', 'main_location', 'sub_location', 'category', 'subcategory')
            ->orderBy('bump_up_at', 'DESC')
            ->where('status', '<',10)
            ->where('user_id', Session::get('user')['id']);

        if($type !="all"){
            if ($type == 'active') {
                $query->where('status', 1);
            } elseif ($type == 'pending') {
                $query->where('status', 0); // Assuming pending ads have status 0, change it accordingly if it's different
            }
        }

        $data = $query->paginate(8);

        return view('web.user.payment', [
            'invoiceId' => $ads->adsId,
            'post'=>0,
            'amount' => $amount,
            'customerFirstName' => $customerFirstName,
            'customerLastName' => $customerLastName,
            'customerMobilePhone' => $customerMobilePhone,
            'customerEmail' => $customerEmail,
            'billingAddressCity' => $billingAddressCity
        ]);

        // return view('web.user.my-ads', ["data" => $data, "type" => $type ,'bumpUp' => 1]);
    }
}
