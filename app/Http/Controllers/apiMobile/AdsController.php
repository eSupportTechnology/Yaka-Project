<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\AdDetail;
use App\Models\Ads;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdsController extends Controller
{
    public function searchByTitle(Request $request)
{
    $searchTerm = $request->input('title');
    $userId = $request->input('user_id');
    if (!$searchTerm) {
        return response()->json([
            'status' => 'error',
            'message' => 'Please provide a title to search.'
        ], 400);
    }

    if (!$userId) {
        return response()->json([
            'status' => 'error',
            'message' => 'Please provide a user ID.'
        ], 400);
    }

    $ads = Ads::where('title', 'LIKE', '%' . $searchTerm . '%')
              ->where('user_id', '!=', $userId)
              ->get();

    if ($ads->isEmpty()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Item not found.',
            'data' => []
        ], 200);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Ads found successfully.',
        'count' => $ads->count(),
        'data' => $ads
    ], 200);
}

//delete ads
public function deleteById($id)
{
    $ad = Ads::find($id);

    if (!$ad) {
        return response()->json([
            'status' => 'error',
            'message' => 'Ad not found.'
        ], 404);
    }

    $ad->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Ad deleted successfully.'
    ], 200);
}


public function postAd(Request $request)
{
    try {
        // Ensure the user is authenticated via API
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $user = auth('sanctum')->user();

        // Extract query parameters
        $cat_id = $request->query('cat_id');
        $sub_cat_id = $request->query('sub_cat_id');
        $location = $request->query('location');
        $sublocation = $request->query('sublocation');

        $formFields = FormField::all();
        $dynamicRules = [];

        foreach ($formFields as $field) {
            $dynamicRules['field_' . $field->id] = 'nullable';
        }

        if ($request->boosting_option == '0') {
            $request->merge(['package_type' => '0']);
        }

        $validationRules = array_merge([
            'title'         => 'required|string|max:255',
            'price'         => 'required|numeric',
            'description'   => 'required|string',
            'main_image'    => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'sub_images'    => 'nullable|array',
            'sub_images.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'brand'         => 'nullable',
            'model'         => 'nullable',
            'condition'     => 'nullable|in:New,Used',
            'pricing_type'  => 'nullable|in:Fixed,Negotiable,Daily,Weekly,Monthly,Yearly',
            'post_type'     => 'nullable|in:Booking,Sale,Rent',
            'boosting_option' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == '0') return;
                    if (!\App\Models\Package::find($value)) {
                        $fail('The selected boosting option is invalid.');
                    }
                }
            ],
            'package_type' => [
                'required_unless:boosting_option,0',
                function ($attribute, $value, $fail) {
                    if (request('boosting_option') != '0' && !\App\Models\PackageType::where('id', $value)->exists()) {
                        $fail('The selected package type is invalid.');
                    }
                }
            ],
        ], $dynamicRules);

        $validated = $request->validate($validationRules);

        $packageExpireAt = null;
        if ($request->boosting_option != '0') {
            $packageType = \App\Models\PackageType::find($validated['package_type']);
            if ($packageType) {
                $packageExpireAt = now()->addDays($packageType->duration);
            }
        }

        // Upload images
        $mainImagePath = $request->file('main_image')->store('ads/main_images', 'public');
        $subImagesPaths = [];

        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('ads/sub_images', 'public');
                    $subImagesPaths[] = $path;
                }
            }
        }

        $ad = Ads::create([
            'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
            'user_id' => $user->id,
            'title' => $validated['title'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'mainImage' => $mainImagePath,
            'subImage' => json_encode($subImagesPaths),
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'price_type' => $validated['pricing_type'] ?? null,
            'post_type' => $validated['post_type'] ?? null,
            'condition' => $validated['condition'] ?? null,
            'ads_package' => $request->boosting_option,
            'package_type' => $request->package_type,
            'package_expire_at' => $packageExpireAt,
            'cat_id' => $cat_id,
            'sub_cat_id' => $sub_cat_id,
            'location' => $location,
            'sublocation' => $sublocation,
            'status' => '0',
        ]);

        foreach ($formFields as $field) {
            $inputName = 'field_' . $field->id;
            $fieldValue = $request->input($inputName);

            if (!is_null($fieldValue) && $fieldValue !== '') {
                AdDetail::create([
                    'adsId' => $ad->adsId,
                    'additional_info' => $field->field_name,
                    'value' => $fieldValue
                ]);
            }
        }

        // Handle redirect for payment if needed
        if ($request->boosting_option != '0') {
            return response()->json([
                'status' => 'pending_payment',
                'message' => 'Ad created. Payment required.',
                'redirect_url' => route('payment.page', [
                    'package_id' => $request->boosting_option,
                    'package_type' => $request->package_type,
                    'selected_package_name' => $request->input('selected_package_name'),
                    'selected_package_price' => $request->input('selected_package_price'),
                    'selected_package_duration' => $request->input('selected_package_duration'),
                    'ad_data' => json_encode(array_merge($request->all(), ['main_image' => $mainImagePath, 'sub_images' => $subImagesPaths])),
                ])
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Ad posted successfully.',
            'data' => $ad
        ]);

    } catch (\Exception $e) {
        Log::error('API Ad Post Error', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Something went wrong! Please try again.'], 500);
    }
}



}
