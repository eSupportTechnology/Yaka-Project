<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\AdsTypes;
use App\Models\Agriculture;
use App\Models\Animal;
use App\Models\BrandsModels;
use App\Models\BusinessAndIndustry;
use App\Models\Category;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Education;
use App\Models\ElectronicDevices;
use App\Models\Essentials;
use App\Models\FashionAndBeauty;
use App\Models\HobbySportsAndKids;
use App\Models\HomeAndGarden;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\Property;
use App\Models\Services;
use App\Models\Vehicle;
use App\Models\Workoverseas;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class AdPostController extends Controller
{
    public function mainAdsPost(Request $request )
    {
        // return $request->all();

        $plan_id = $request->plan_id ?? 0;

        if ($plan_id){
            $plan = PackageType::with('package')->where('id',$plan_id)->where('status',1)->get();
//            go to payment-G
        }

        $category = Category::where('id', $request->catId)->select('url')->first();

        $subcategory = Category::where('id', $request->subcatId)->select('url')->first();

        //return $subcategory->url;
        // Validate the request data


        $validatedData = $this->validateRequest($request, $subcategory->url);

        // Store the main image
        $mainImage = $request->file('mainImage');
  
        $imageName = $this->storeImage($mainImage);

        // Store sub images and concatenate their names
        $images = [];
        $subimage_name = "";
        $imageFields = ['subImage1', 'subImage2', 'subImage3', 'subImage4'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $images[$field] = $this->storeImage($request->file($field));
                // Concatenate the image names
                $subimage_name .= "[" . $images[$field] . "], ";
            }
        }

        // Remove the trailing comma and space
        $subimage_name = rtrim($subimage_name, ', ');

        // Generate URL for the ad based on the title
        $url = $this->generateUrl($validatedData['title']); // Utilizing Str class from Illuminate\Support

        // Fetch category URLs for the specified category and subcategory
        $categoryUrls = $this->fetchCategoryUrls([$request->catId, $request->subcatId]);

        // Fetch brands for the specified subcategory
        $brands = $this->fetchBrands($request->subcatId);

        // Fetch brands for the specified subcategory
        $types = $this->fetchTypes($request->subcatId);
        $plans = Package::where('status',1)->with('packageTypes')->get();
        $adsId = rand();

        // Merge validated data with additional fields
        $adsData = array_merge($validatedData, [
            'url' => $url, // Accessing the URL based on the catId
            'adsId' => $adsId,
            'mainImage' => $imageName,
            'price_type' => $request->price_type,
            'post_type' => $request->post_type,
            'subImage' => $subimage_name,
            'bump_up_at' => Carbon::now(),
            'cat_id' => $request->catId ?? null,
            'sub_cat_id' => $request->subcatId ?? null,
            'user_id' => $request->userId ?? null,
            'ads_package' => $request->ads_package ?? null,
            'package_type' => $request->package_type ?? null,
            'package_expire_at' => $request->package_expire_at ?? null,
            'status' => 0,
        ]);

        // Create a new Ads instance and save to database
        if (Ads::create($adsData)) {
            if ($category->url === 'electronics') {
                $this->electronicdevices($adsId, $request->condition ?? null, $request->brand ?? null, $request->model ?? null, $request->specialization ?? null, $request->type ?? null, $request->ssize ?? null, $request->capacity ?? null);
            }
            if ($category->url === 'vehicles') {
                $this->vehicle($adsId, $request->condition ?? null, $request->brand ?? null, $request->model ?? null, $request->type ?? null, $request->manufacture_year ?? null, $request->engine_capacity ?? null, $request->gears_up ?? null, $request->fragment_type ?? null, $request->Mileage ?? null, $request->edition ?? null, $request->model_year ?? null, $request->fuel_Type ?? null, $request->transmission ?? null,$request->bike_type ?? null);
            }
            if ($category->url === 'property') {
                $this->property($adsId, $request->status ?? null, $request->brand ?? null, $request->size_of_land ?? null, $request->size_sf ?? null, $request->unit ?? null, $request->address ?? null, $request->rooms ?? null, $request->bathrooms ?? null, $request->type ?? null);
            }
            if ($category->url === 'animals') {
                $this->animal($adsId, $request->type ?? null, $request->status ?? null);
            }
            if ($category->url === 'services') {
                $this->services($adsId, $request->type ?? null);
            }
            if ($category->url === 'home-garden') {
                $this->homeAndGarden($adsId,$request->type ?? null,$request->condition ?? null,$request->brand ?? null);
            }
            if ($category->url === 'business-and-industry') {
                $this->businessAndIndustry($adsId, $request->type ?? null, $request->condition ?? null);
            }
            if ($category->url === 'hobby-sports-and-kids') {
                $this->hobbySportAndKids($adsId, $request->type ?? null, $request->condition ?? null,$request->gender ?? null);
            }
            if ($category->url === 'fashion-and-beauty') {
                $this->fashionAndBeauty($adsId, $request->type ?? null, $request->condition ?? null,$request->gender ?? null);
            }
            if ($category->url === 'essentials') {
                $this->essentials($adsId, $request->type ?? null, $request->condition ?? null);
            }
            if ($category->url === 'education') {
                $this->education($adsId, $request->type ?? null, $request->condition ?? null);
            }
            if ($category->url === 'agriculture') {
                $this->agriculture($adsId);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully!',
        ], 200);
        // Pass data to the view
    }
    private function electronicdevices($ad_id, $condition, $brand, $model, $specialization, $type, $sreeen_size, $capacity)
    {
        $specialization_list = '';
        // if ($specialization && !empty($specialization)) {
        //     foreach ($specialization as $specialization_item) {
        //         // Assuming each specialization item is an object or an array with a 'specialization' property
        //         $specialization_list .= $specialization_item . ", ";
        //     }
        //     // Remove the trailing comma and space
        //     $specialization_list = rtrim($specialization_list, ', ');
        // }

        $adsData = [
            'adsId' => $ad_id,
            'condition' => $condition,
            'brand' => $brand,
            'model' => $model,
            'specialization' => implode(', ', $specialization),
            // 'specialization' => $specialization_list,
            'type' => $type,
            'screen_size' => $sreeen_size,
            'capacity' => $capacity,
        ];
        ElectronicDevices::create($adsData);
    }
    //vehicle
    private function vehicle($adsId, $condition, $brand, $model, $type, $manufacture_year, $engine_capacity, $gears_up, $fragment_type, $Mileage, $edition, $model_year, $fuel_Type, $transmission,$bike_type)
    {
        $adsData = [
            'adsId' => $adsId,

            'condition' => $condition,
            'brand' => $brand,
            'model' => $model,
            'type' => $type,
            'manufacture_year' => $manufacture_year,
            'engine_capacity' => $engine_capacity,
            'gears_up' => $gears_up,
            'fragment_type' => $fragment_type,
            'Mileage' => $Mileage,
            'edition' => $edition,
            'model_year' => $model_year,
            'fuel_Type' => $fuel_Type,
            'transmission' => $transmission,
            'bike_type'=>$bike_type,
        ];

        Vehicle::create($adsData);
    }
    //property
    private function property($adsId, $status, $brand, $size_of_land, $size_sf, $unit, $address, $rooms, $bathrooms, $type)
    {
        $adsData = [
            'adsId' => $adsId,
            'status' => $status,
            'brand' => $brand,
            'size_of_land' => $size_of_land,
            'size_sf' => $size_sf,
            'unit' => $unit,
            'address' => $address,
            'rooms' => $rooms,
            'bathrooms' => $bathrooms,
            'type' => $type,

        ];

        Property::create($adsData);
    }
    //animals
    private function animal($adsId, $type, $status)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'status' => $status,
        ];
        Animal::create($adsData);
    }
    //Services
    private function services($adsId, $type)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
        ];
        Services::create($adsData);
    }
    //Business and industry
    private function businessAndIndustry($adsId, $type, $status)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
        ];
        BusinessAndIndustry::create($adsData);
    }
    //hobby,sports and kids
    private function hobbySportAndKids($adsId, $type, $status,$gender)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
            'gender' => $gender
        ];
        HobbySportsAndKids::create($adsData);
    }
    //Fashion and Beauty
    private function fashionAndBeauty($adsId, $type, $status,$gender)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
            'gender' => $gender
        ];
        FashionAndBeauty::create($adsData);
    }
    //Essentials
    private function education($adsId, $type, $status)
    {
        $adsData = [
            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
        ];
        Education::create($adsData);
    }
    private function essentials($adsId, $type, $status)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
        ];
        Essentials::create($adsData);
    }
    //Agriculture
    private function agriculture($adsId)
    {
        $adsData = [

            'adsId' => $adsId,

        ];
        Agriculture::create($adsData);
    }
    //Home and garden
    private function homeAndGarden($adsId,$type,$status,$brand)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
            'brand'=>$brand,

        ];
        HomeAndGarden::create($adsData);
    }
    // Method to validate the request data
    private function validateRequest(Request $request, $subcategory)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'location' => 'required|numeric|not_in:0',
            'sublocation' => 'required|numeric|not_in:0',
            'description' => 'required|string|max:255',
            'price' => 'required',
            'mainImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $subcategoriesRules = [
            'mobile-phones' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
            ],
            'tv-video-accessories' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'mobile-phone-accessories' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'computers-tablets' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'computer-accessories' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'audio-mp3' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'video-games-consoles' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'air-conditions-electrical-fittings' => [
                'brand' => 'required|numeric|not_in:0',
                'capacity' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'electronic-home-appliances' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'cameras-camcorders' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'tvs' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
                'ssize' => 'required|numeric|not_in:0',
            ],


            'cars' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
                'manufacture_year' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
                'fuel_Type' => 'required|numeric|not_in:0',
                'transmission' => 'required|numeric|not_in:0',
            ],
            'motorbikes' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required',
                'manufacture_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
            ],
            'three-wheelers' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required',
                'fuel_Type' => 'required|numeric|not_in:0',
                'manufacture_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
            ],
            'bicycles' => [
                'brand' => 'required|numeric|not_in:0',
            ],
            'vans' => [
                'brand' => 'required|numeric|not_in:0',
                'manufacture_year' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
                'fuel_Type' => 'required|numeric|not_in:0',
            ],
            'buses' => [
                'brand' => 'required|numeric|not_in:0',
                'manufacture_year' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
            ],
            'lorries-trucks' => [
                'brand' => 'required|numeric|not_in:0',
                'manufacture_year' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
            ],
            'heavy-duty' => [
                'brand' => 'required|numeric|not_in:0',
            ],
            'tractors' => [
                'brand' => 'required|numeric|not_in:0',
                'edition' => 'required|numeric|not_in:0',
                'manufacture_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
            ],
            'auto-services' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'rentals' => [
                'type' => 'required|numeric|not_in:0',
            ],


            'land-for-sale' => [
                'type' => 'required|numeric|not_in:0',
                'size_of_land' => 'required|numeric|not_in:0',
                'address' => 'required',
            ],
            'houses-for-sale' => [
                'rooms' => 'required|numeric|not_in:0',
                'bathrooms' => 'required|numeric|not_in:0',
                'size_of_land' => 'required|numeric|not_in:0',
                'size_sf' => 'required|numeric|not_in:0',
                'address' => 'required',
            ],
            'apartments-for-sale' => [
                'rooms' => 'required|numeric|not_in:0',
                'bathrooms' => 'required|numeric|not_in:0',
                'size_sf' => 'required|numeric|not_in:0',
                'address' => 'required',
            ],
            'commercial-properties-for-sale' => [
                'type' => 'required|numeric|not_in:0',
                'size_sf' => 'required|numeric|not_in:0',
                'address' => 'required',

            ],


            'pets' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'farm-animals' => [
                'type' => 'required|numeric|not_in:0',
            ],


            'trade-services' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'domestic-services' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'events-entertainment' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'health-wellbeing' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'travel-tourism' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'other-services' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'other-business-services' => [
                'type' => 'required|numeric|not_in:0',
            ],



            'musical-instruments' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'sports-fitness' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'travel-events-tickets' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'music-books-movies' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'children-s-items' => [
                'type' => 'required|numeric|not_in:0',
                'gender' => 'required|numeric|not_in:0',
            ],


            'beauty-products' => [
                'type' => 'required|numeric|not_in:0',
            ],


            'grocery' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'meat-seafood' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'baby-products' => [
                'type' => 'required|numeric|not_in:0',
            ],


            'textbooks' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'tuition' => [
                'type' => 'required|numeric|not_in:0',
            ],




            'furniture'=>[
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'bathroom-sanitary-ware'=>[
                'type' => 'required|numeric|not_in:0',
            ],
            'building-material-tools'=>[
                'type' => 'required|numeric|not_in:0',
            ],
            'garden'=>[

                'type' => 'required|numeric|not_in:0',
            ],
            'home-decor'=>[

                'type' => 'required|numeric|not_in:0',
            ],
            'kitchen-items'=>[
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ]


        ];

        if (array_key_exists($subcategory, $subcategoriesRules)) {
            // Merge the rules for the specific subcategory with the $rules array
            $rules += $subcategoriesRules[$subcategory];
        }



        return $request->validate($rules);
    }
    // Method to store the uploaded image
    private function storeImage($image)
    {
        $imageName = time() . random_int(1, 100) . '.' . $image->extension();
        $image->move(public_path('images/Ads/'), $imageName);
        return $imageName;
    }
    // Method to generate URL from the title
    private function generateUrl($title)
    {
        $url = strtolower($title);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);
        return $url;
    }
    // Method to fetch category URLs
    private function fetchCategoryUrls($categoryIds)
    {
        return Category::whereIn('id', $categoryIds)->pluck('url', 'id');
    }
    // Method to fetch brands for a given subcategory
    private function fetchBrands($subcategoryId)
    {
        return BrandsModels::where('sub_cat_id', $subcategoryId)
            ->where('brandsId', 0)
            ->where('status', 1)
            ->get();
    }
    private function fetchTypes($subcategoryId)
    {
        return AdsTypes::where('catergoryId', $subcategoryId)
            ->where('status', 1)
            ->get();
    }
    // Method to fetch cities
    private function fetchCities()
    {
        return Cities::select('id', 'name_en')->get();
    }
    // Method to fetch districts
    private function fetchDistricts()
    {
        return Districts::select('id', 'name_en')->get();
    }
}



//    "api": true,
//    "title": "rukshan title",
//    "price": "2333",
//    "price_type": "1",
//    "description": "sdfsdfsdfsdf",
//    "post_type": "1",
//    "catId": "1",
//    "subcatId": "2",
//    "userId": "1",
//    "location": "16",
//    "sublocation": "1309",
//    "plan_id": "0",
//    "mainImage": [],
//    "subImage1": [],
//    "subImage2": [],
//    "subImage3": [],
//    "subImage4": []
