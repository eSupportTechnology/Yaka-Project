<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\AdsTypes;
use App\Models\BrandsModels;
use App\Models\Category;
use App\Models\Cities;
use Illuminate\Support\Facades\Log;
use App\Models\Districts;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class userDashboardController extends Controller
{

    public function index()
    {app()->setlocale(Session::get('locale'));
        // Render the dashboard view for the user
        return view('web.user.dashboard');
    }

    public function mainCategories()
    {app()->setlocale(Session::get('locale'));
        // Fetch all main categories with status 1
        $maincategories = Category::where('status', 1)->where('mainId', 0)->get();

        // Render the main categories view with the fetched data
        return view('web.user.main-categories',['maincategories'=>$maincategories]);
    }

    public function subCategories($url)
    {app()->setlocale(Session::get('locale'));
        // Fetch main categories, the requested main category, and its subcategories
        $maincategories = Category::where('status', 1)
            ->where('mainId', 0)
            ->get();

        // Find the requested main category by URL
        $okmaincategory = Category::where('url', $url)
            ->where('status', 1)
            ->firstOrFail();

        // Fetch subcategories of the requested main category
        $subcategories = Category::where('status', 1)
            ->where('mainId', $okmaincategory->id)
            ->get();

        // Render the main categories view with the fetched data
        return view('web.user.main-categories', [
            'maincategories' => $maincategories,
            'okmaincategory' => $okmaincategory,
            'subcategories' => $subcategories,
        ]);
    }

    public function postForm($curl, $surl)
    {app()->setlocale(Session::get('locale'));
        // Fetch category and subcategory IDs
        $categoryIds = Category::whereIn('url', [$curl, $surl])->pluck('id', 'url');

        // Fetch brands based on the subcategory ID
        $brandmodels = BrandsModels::where('sub_cat_id', $categoryIds[$surl])
            // ->where('brandsId', 0)
            ->where('status', 1)
            ->get();


            $havemodel = [];

            foreach ($brandmodels as $key => $value) {
                if($value->brandsId != 0){
                    $havemodel[] = $value->brandsId;
                }
            }


            $brands = BrandsModels::where('sub_cat_id', $categoryIds[$surl])
            ->whereIn('id', $havemodel)
            ->where('brandsId', 0)
            ->where('status', 1)
            ->get();

       


        

        // Fetch brands based on the subcategory ID
        $types = AdsTypes::where('catergoryId', $categoryIds[$surl])
            ->where('status', 1)
            ->get();

        // Fetch cities and districts with only necessary columns
        $cities = Cities::select('id', 'name_en')->get();
        $districts = Districts::select('id', 'name_en')->get();

        $plans = Package::where('status',1)->with('packageTypes')->get();

        // Render the post ads view with the fetched data
        return view('web.user.post-ads', [
            'catId' => $categoryIds[$curl],
            'subcatId' => $categoryIds[$surl],
            'maincategoryurl' => $curl,
            'plans' => $plans,
            'subcategoryurl' => $surl,
            'brands' => $brands,
            'types' => $types,
            'cities' => $cities,
            'districts' => $districts,
        ]);
    }

    public function getModels(Request $request)
    {app()->setlocale(Session::get('locale'));
        // Get the brand ID from the request
        $brandId = $request->input('brandId');

        // Check if the Brand with the given ID exists
        $brand = BrandsModels::find($brandId);

        // If brand not found, return a JSON response with an error message
        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        // Fetch models associated with the given brand ID
        $models = BrandsModels::where('brandsId', $brandId)->get();

        // Return the models as a JSON response
        return response()->json($models);
    }

    public function getSubLocation(Request $request)
    {app()->setlocale(Session::get('locale'));
        // Get the brand ID from the request
        $location = $request->input('location');

        // Check if the Brand with the given ID exists
        $districts = Districts::find($location);

        // If brand not found, return a JSON response with an error message
        if (!$districts) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        // Fetch models associated with the given brand ID
        $cities = Cities::where('district_id', $location)->get();

        // Return the models as a JSON response
        return response()->json($cities);
    }

    public function setting()
    {app()->setlocale(Session::get('locale'));

        // Fetch cities and districts with only necessary columns
        $cities = Cities::select('id', 'name_en')->get();
        $districts = Districts::select('id', 'name_en')->get();

        return view('web.user.setting',['cities'=>$cities , 'districts'=> $districts]);
    }

    public function update(Request $request)
    {app()->setlocale(Session::get('locale'));
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->userId),
            ],
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'phone_number' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
                Rule::unique('users')->ignore($request->userId),
            ],
        ];

        $request->validate($rules);

        $url = strtolower($request['name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);


        // Store the main image
        if ($request->hasFile('image')) {
            // Get the file from the request
            $image = $request->file('image');

            // Generate a unique filename
            $filename = time() . '_'.$url. '.'. $image->extension();

            // Store the file in the storage disk (assuming 'public' disk)
            $path = $image->move('images/user/', $filename);

        }



        $user = User::find($request->userId);
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->profileImage = $filename ?? $user->profileImage;
        $user->last_name = $request->last_name;
        $user->url = $url;
        $user->company = $request->company;
        $user->location = $request->location;
        $user->sub_location = $request->sublocation;
        $user->postCode = $request->postCode;
        $user->country = $request->country;
        $user->website = $request->website;
        $user->phone_number = $request->phone_number;
        $user->birthday = $request->birthday;

        $user->save();

        $cities = Cities::select('id', 'name_en')->get();
        $districts = Districts::select('id', 'name_en')->get();

        $userAttributes = $user->getAttributes();
        unset($userAttributes['password']); // Remove the 'password' attribute from the array
        session(['user' => $userAttributes]);

        // Decide whether you want to return a view or JSON response
        return view('web.user.setting', ['cities' => $cities, 'districts' => $districts])->with('message', 'User updated successfully');
    }

    public function myAds($type)
    {app()->setlocale(Session::get('locale'));
        $query = Ads::with('ads_vehicles','ads_electronics', 'main_location', 'sub_location', 'category', 'subcategory')
            ->orderBy('id', 'DESC')
            ->where('user_id', Session::get('user')['id']);

       if($type !="all"){
           if ($type == 'active') {
               $query->where('status', 1);
           } elseif ($type == 'pending') {
               $query->where('status', 0); // Assuming pending ads have status 0, change it accordingly if it's different
           }
       }else{
           $query->where('status', '<',10);
       }

        $data = $query->paginate(8);

        return view('web.user.my-ads', ["data" => $data, "type" => $type ,'bumpUp' => 1]);
    }


    public function payment(){
        app()->setlocale(Session::get('locale'));
        return view('web.user.payment');
    }

 





}
