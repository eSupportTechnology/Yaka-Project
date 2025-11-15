<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Ads;
use App\Models\BrandsModels;
use App\Models\Category;
use App\Models\Districts;
use App\Models\FormField;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class userDashboardController extends Controller
{
    public function index()
    {
        return view('newFrontend.user.dashboard');
    }

    public function my_ads()
    {
        $user = auth()->user();
        $activeAds = Ads::where('user_id', $user->id)->where('status', 1)->get();
        $pendingAds = Ads::where('user_id', $user->id)->whereIn('status', [0, 10])->get();

        return view('newFrontend.user.my_ads', compact('activeAds', 'pendingAds'));
    }

    public function edit(Request $request, $adsId, $cat_id)
{
    $ad = Ads::findOrFail($adsId);

    $categories = Category::where('status', 1)->where('mainId', 0)->get();
    $subcategories = Category::where('mainId', $ad->cat_id)->get();
    $brands = BrandsModels::where('sub_cat_id', $ad->sub_cat_id)->where('brandsId', 0)->get();
    $models = BrandsModels::where('brandsId', $ad->brand)->where('sub_cat_id', $ad->sub_cat_id)->get();

    $formFields = FormField::where('main_category_id', $ad->cat_id)
        ->where('subcategory_id', $ad->sub_cat_id)
        ->get();

    $packages = Package::with('packageTypes')
        ->where('name', '!=', 'Jump Up')
        ->where('id', '!=', 5)
        ->get();

    // overwrite only if passed via ?cat_id=...
    if ($request->cat_id) {
        $cat_id = $request->cat_id;
        $subcategories = Category::where('mainId', $cat_id)->get();
    }

    return view('newFrontend.user.edit-ad', [
        'ad' => $ad,
        'categories' => $categories,
        'subcategories' => $subcategories,
        'brands' => $brands,
        'models' => $models,
        'formFields' => $formFields,
        'packages' => $packages,
        'adsId' => $adsId,
        'cat_id' => $cat_id, // <-- final value
    ]);
}


    public function update(Request $request, $adsId)
{
    $ad = Ads::findOrFail($adsId);

    $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'mobile1' => 'nullable|string|max:20',
        'mobile2' => 'nullable|string|max:20',
        'brand' => 'nullable|exists:brands_models,id',
        'model' => 'nullable|string|max:50',
        'condition' => 'nullable|string|max:50',
        'main_image' => 'nullable|image|max:10048',
        'sub_images.*' => 'nullable|image|max:10048',
        'price_type' => 'nullable|string|max:50',
        'post_type' => 'nullable|string|max:50',
        'boosting_option' => 'nullable|integer',
        'package_type' => 'nullable|integer',
        'address' => 'nullable|string|max:255',
        'bed_room' => 'nullable|integer|min:0',
        'bath_room' => 'nullable|integer|min:0',
        'house_size' => 'nullable|string|max:50',
        'land_size' => 'nullable|string|max:50',
    ]);

    $ad->title = $request->title;
    $ad->price = $request->price;
    $ad->description = $request->description;
    $ad->mobile1 = $request->mobile1;
    $ad->mobile2 = $request->mobile2;
    $ad->brand = $request->brand;
    $ad->model = $request->model;
    $ad->condition = $request->condition;
    $ad->price_type = $request->price_type;
    $ad->post_type = $request->post_type;
    $ad->ads_package = $request->boosting_option;
    $ad->package_type = $request->package_type;
    $ad->address = $request->address;
    $ad->bed_room = $request->bed_room;
    $ad->bath_room = $request->bath_room;
    $ad->house_size = $request->house_size;
    $ad->land_size = $request->land_size;

    if ($request->hasFile('main_image')) {
        if ($ad->mainImage && Storage::disk('public')->exists($ad->mainImage)) {
            Storage::disk('public')->delete($ad->mainImage);
        }

        $mainImagePath = $request->file('main_image')->store('ads', 'public');
        $ad->mainImage = $mainImagePath;
    }

    if ($request->hasFile('sub_images')) {
        $subImages = [];

        if ($ad->subImage) {
            foreach (json_decode($ad->subImage, true) as $oldImg) {
                if (Storage::disk('public')->exists($oldImg)) {
                    Storage::disk('public')->delete($oldImg);
                }
            }
        }

        foreach ($request->file('sub_images') as $file) {
            $path = $file->store('ads', 'public');
            $subImages[] = $path;
        }

        $ad->subImage = json_encode($subImages);
    }

    $ad->save();

    return redirect()
        ->route('user.my_ads')
        ->with('success', 'Ad updated successfully!');
}

    public function profile()
    {
        $user = auth()->user();
        $districts = Districts::all();

        return view('newFrontend.user.profile', compact('user', 'districts'));
    }


    public function getCities(Request $request)
    {
        if ($request->ajax()) {
            Log::info('Request Data:', $request->all()); // Debugging

            if (!$request->has('district_id')) {
                return response()->json(['error' => 'Invalid request, district_id missing'], 400);
            }

            $cities = Cities::where('district_id', $request->district_id)->get();

            if ($cities->isEmpty()) {
                return response()->json(['error' => 'No cities found for this district'], 404);
            }

            return response()->json($cities);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }



    public function destroy($adsId)
    {
        $ad = Ads::findOrFail($adsId);
        $ad->delete();

        return redirect()->route('user.my_ads')->with('success', 'Ad deleted successfully!');
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        //dd($request);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'postCode' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'location' => 'nullable|exists:districts,id',
            'sublocation' => 'nullable|exists:cities,id',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company' => $request->company,
            'postCode' => $request->postCode,
            'website' => $request->website,
            'phone_number' => $request->phone_number,
            'birthday' => $request->birthday,
            'location' => $request->location,
            'sub_location' => $request->sublocation,
        ];

        //dd($data);

        if ($request->hasFile('profileImage')) {
            // Delete old image if exists
            if ($user->profileImage) {
                Storage::delete('public/profile_images/' . $user->profileImage);
            }

            $originalName = $request->file('profileImage')->getClientOriginalName();
            $request->file('profileImage')->storeAs('public/profile_images', $originalName);

            $data['profileImage'] = $originalName;
        }

        $user->update($data);

        return redirect()->route('user.profile')->with('message', 'Profile updated successfully!');
    }


    public function logout()
    {
        return view('newFrontend.user.logout');
    }


}
