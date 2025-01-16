<?php

namespace App\Http\Controllers\web;

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
use App\Models\Jobs;
use App\Models\Other;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\Property;
use App\Models\Services;
use App\Models\Vehicle;
use App\Models\Workoverseas;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class adsPosttController extends Controller
{
    public function mainAdsPost(Request $request )
    {
        app()->setlocale(Session::get('locale'));
        $addPostParameters = [
            'status' => true,
            'massege' => 'gfhfghfgh',
        ];

        $plan_id = $request->plan_id ?? 0;

     
        $package = 0;
        $package_type = 0;
        $status = 0;
        $extra_date = 0;

        

        if ($plan_id){


            $plan = PackageType::with('package')->where('id',$plan_id)->where('status',1)->first();

          
            
            $package = $plan->package->id;
            $extra_date = $plan->duration;
            $price = $plan->price;
            $package_type = $plan->id;
            $status = 10;


        }


      

        $category = Category::where('id', $request->catId)->select('url','free_add_count')->first();

        $freeAddCount = $category->free_add_count;


        $catUrl = $category->url;

        $user = Auth()->user()->$catUrl;

            if  ($plan_id == 0){

                if($freeAddCount > $user ){

                    Auth()->user()->$catUrl = $user+1;
                    Auth()->user()->save();
                    $addPostParameters['status'] = true;
    
                    $addPostParameters['massege'] = 'dfgdfgdf';
        
                }else{
        
                    $addPostParameters['status'] = false;
                    $addPostParameters['massege'] = 'You have reached free adds limit';
               
                }
            }        
        if($addPostParameters['status']){
            $subcategory = Category::where('id', $request->subcatId)->select('url')->first();

            //return $subcategory->url;
            // Validate the request data
            // return $request;
    
            if ($category->url != 'jobs'){
                $validatedData = $this->validateRequest($request, $subcategory->url);
            }else{
                $validatedData = $this->validateRequest($request, $category->url);
            }
    
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
                'ads_package' => $package,
                'package_type' => $package_type,
                'package_expire_at' => $extra_date == 0 ? $extra_date : Carbon::now()->addDays($extra_date),
                'status' => $status,
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

                if ($category->url === 'other-ads') {
                    $this->other($adsId);
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
                if ($category->url === 'jobs') {
                    $this->jobs($adsId,$request->job_type ?? null,$request->role ?? null,$request->education ?? null,$request->application_deadline ?? null,$request->experience ?? null,$request->salary_per_month ?? null,$request->cv_sent_email ?? null);
                }
            }

            if ($plan_id){
                 // Get the authenticated user
                    $user = Auth()->user();
                    
                    // Generate random invoice ID
                    $invoiceId = rand();
                    
                    // Get the amount (replace $price with the actual price or a default value)
                    $amount = $price ?? 0;
                    
                    // User details
                    $customerFirstName = $user->first_name;
                    $customerLastName = $user->last_name;
                    $customerMobilePhone = $user->phone_number;
                    $customerEmail = $user->email ?? 'test@gmail.com';

                    // Billing address
                    $billingAddressCity = 'Colombo';

                    // Pass data to the view
                    return view('web.user.payment', [
                        'invoiceId' => $adsId,
                        'post'=>1,
                        'amount' => $amount,
                        'customerFirstName' => $customerFirstName,
                        'customerLastName' => $customerLastName,
                        'customerMobilePhone' => $customerMobilePhone,
                        'customerEmail' => $customerEmail,
                        'billingAddressCity' => $billingAddressCity
                    ]);
    
            }else{
                // return view('web.user.post-ads', [
                //     'catId' => $request->catId,
                //     'subcatId' => $request->subcatId,
                //     'maincategoryurl' => $categoryUrls[$request->catId],
                //     'subcategoryurl' => $categoryUrls[$request->subcatId],
                //     'brands' => $brands,
                //     'types' => $types,
                //     'plans' => $plans,
                //     'cities' => $this->fetchCities(),
                //     'districts' => $this->fetchDistricts(),
                // ]);
                return redirect()->route('user.dashboard')->with('success', 'Ad posted successfully.');
            }

        }else{

            return redirect()->route('user.dashboard')->with('error', $addPostParameters['massege']);
            
        } 

       
        }

    private function electronicdevices($ad_id, $condition, $brand, $model, $specialization, $type, $sreeen_size, $capacity)
    {
        app()->setlocale(Session::get('locale'));
        $specialization_list = '';
        if ($specialization && !empty($specialization)) {
            foreach ($specialization as $specialization_item) {
                // Assuming each specialization item is an object or an array with a 'specialization' property
                $specialization_list .= $specialization_item . ", ";
            }
            // Remove the trailing comma and space
            $specialization_list = rtrim($specialization_list, ', ');
        }
        $adsData = [
            'adsId' => $ad_id,
            'condition' => $condition,
            'brand' => $brand,
            'model' => $model,
            'specialization' => $specialization_list,
            'type' => $type,
            'screen_size' => $sreeen_size,
            'capacity' => $capacity,
        ];
        ElectronicDevices::create($adsData);
    }

    private function jobs($ad_id, $job_type, $role, $education, $application_deadline, $experience, $salary_per_month, $cv_sent_email)
    { app()->setlocale(Session::get('locale'));
        $education_list = '';
        if ($education && !empty($education)) {
            foreach ($education as $education_item) {
                // Assuming each specialization item is an object or an array with a 'specialization' property
                $education_list .= $education_item . ", ";
            }
            // Remove the trailing comma and space
            $education_list = rtrim($education_list, ', ');
        }


        $job_type_list = '';
        if ($job_type && !empty($job_type)) {
            foreach ($job_type as $job_type_item) {
                // Assuming each specialization item is an object or an array with a 'specialization' property
                $job_type_list .= $job_type_item . ", ";
            }
            // Remove the trailing comma and space
            $job_type_list = rtrim($job_type_list, ', ');
        }


        $adsData = [
            'adsId' => $ad_id,
            'job_type' => $job_type_list,
            'role' => $role,
            'education' => $education_list,
            'application_deadline	' => $application_deadline,
            'experience' => $experience,
            'salary_per_month' => $salary_per_month,
            'cv_sent_email' => $cv_sent_email,
        ];
        Jobs::create($adsData);
    }

    //vehicle
    private function vehicle($adsId, $condition, $brand, $model, $type, $manufacture_year, $engine_capacity, $gears_up, $fragment_type, $Mileage, $edition, $model_year, $fuel_Type, $transmission,$bike_type)
    { app()->setlocale(Session::get('locale'));
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
    { app()->setlocale(Session::get('locale'));
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
    { app()->setlocale(Session::get('locale'));
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'status' => $status,
        ];
        Animal::create($adsData);
    }
    //Services
    private function services($adsId, $type)
    { app()->setlocale(Session::get('locale'));
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
        ];
        Services::create($adsData);
    }
    private function other($adsId)
    { app()->setlocale(Session::get('locale'));
        $adsData = [

            'adsId' => $adsId,
        ];
        Other::create($adsData);
    }
    //Business and industry
    private function businessAndIndustry($adsId, $type, $status)
    { app()->setlocale(Session::get('locale'));
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'status' => $status,
        ];
        BusinessAndIndustry::create($adsData);
    }
    //hobby,sports and kids
    private function hobbySportAndKids($adsId, $type, $status,$gender)
    { app()->setlocale(Session::get('locale'));
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
    { app()->setlocale(Session::get('locale'));
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
    { app()->setlocale(Session::get('locale'));
        $adsData = [
            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
        ];
        Education::create($adsData);
    }
    private function essentials($adsId, $type, $status)
    { app()->setlocale(Session::get('locale'));
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'condition' => $status,
        ];
        Essentials::create($adsData);
    }
    //Agriculture
    private function agriculture($adsId)
    { app()->setlocale(Session::get('locale'));
        $adsData = [

            'adsId' => $adsId,

        ];
        Agriculture::create($adsData);
    }
     //Home and garden
     private function homeAndGarden($adsId,$type,$status,$brand)
     { app()->setlocale(Session::get('locale'));
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
    { app()->setlocale(Session::get('locale'));
        $rules = [
            'title' => 'required|string|max:255',
            'location' => 'required|numeric|not_in:0',
            'sublocation' => 'required|numeric|not_in:0',
            'description' => 'required|string',
            'price' => 'required',
            'mainImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subImage4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'mainImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=380,height=270',
            // 'subImage1' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=380,height=270',
            // 'subImage2' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=380,height=270',
            // 'subImage3' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=380,height=270',
            // 'subImage4' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=380,height=270',

        ];
        $subcategoriesRules = [

            'mobile-phones' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
            ],


            'jobs' => [
                'role' => 'required',
                'job_type' => 'required',
                'experience' => 'required',
                'education' => 'required',
                'application_deadline' => 'required',
                'cv_sent_email' => 'required',
                'salary_per_month'=> 'required',
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
                'rooms' => 'required|numeric',
                'bathrooms' => 'required|numeric',
                'size_of_land' => 'required|numeric',
                'size_sf' => 'required|numeric',
                'address' => 'required',
            ],
            'apartments-for-sale' => [
                'rooms' => 'required|numeric',
                'bathrooms' => 'required|numeric',
                'size_sf' => 'required|numeric',
                'address' => 'required',
            ],
            'commercial-properties-for-sale' => [
                'type' => 'required|numeric',
                'size_sf' => 'required|numeric',
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
    // private function storeImage($image)
    // {
    //     $imageName = time() . random_int(1, 100) . '.' . $image->extension();
    //     $image->move(public_path('images/Ads/'), $imageName);
    //     return $imageName;
    // }


    private function storeImage($image)
{ app()->setlocale(Session::get('locale'));
    $imageName = time() . random_int(1, 100) . '.' . $image->extension();
    $imagePath = public_path('images/Ads/') . $imageName;

    // Move the image to destination path
    $image->move(public_path('images/Ads/'), $imageName);

    // Add watermark
    $img = imagecreatefromstring(file_get_contents($imagePath));
    $fontPath = public_path('fonts/Arial.ttf'); // Specify your font file path
    $fontSize = 30; // Font size for the watermark
    $text = "YAKA.LK";

    // Set color to white with 25% opacity
    $color = imagecolorallocatealpha($img, 255, 255, 255, 95);

    // Calculate text position for center alignment
    $textBox = imagettfbbox($fontSize, 0, $fontPath, $text);
    $textWidth = $textBox[2] - $textBox[0];
    $textHeight = $textBox[1] - $textBox[7];
    $textX = (imagesx($img) - $textWidth) / 2;
    $textY = (imagesy($img) + $textHeight) / 2;

    // Add bold effect by duplicating the text with slight offset
    imagettftext($img, $fontSize, 0, $textX, $textY, $color, $fontPath, $text);
    imagettftext($img, $fontSize, 0, $textX + 1, $textY + 1, $color, $fontPath, $text);

    // Save the watermarked image
    imagejpeg($img, $imagePath);

    // Free up memory
    imagedestroy($img);

    return $imageName;
}

    // Method to generate URL from the title
    private function generateUrl($title)
    { app()->setlocale(Session::get('locale'));
        $url = strtolower($title);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);
        return $url;
    }
    // Method to fetch category URLs
    private function fetchCategoryUrls($categoryIds)
    { app()->setlocale(Session::get('locale'));
        return Category::whereIn('id', $categoryIds)->pluck('url', 'id');
    }
    // Method to fetch brands for a given subcategory
    private function fetchBrands($subcategoryId)
    { app()->setlocale(Session::get('locale'));
        return BrandsModels::where('sub_cat_id', $subcategoryId)
            ->where('brandsId', 0)
            ->where('status', 1)
            ->get();
    }
    private function fetchTypes($subcategoryId)
    { app()->setlocale(Session::get('locale'));
        return AdsTypes::where('catergoryId', $subcategoryId)
            ->where('status', 1)
            ->get();
    }
    // Method to fetch cities
    private function fetchCities()
    { app()->setlocale(Session::get('locale'));
        return Cities::select('id', 'name_en')->get();
    }
    // Method to fetch districts
    private function fetchDistricts()
    { app()->setlocale(Session::get('locale'));
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
