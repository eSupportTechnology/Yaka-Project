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
use App\Models\Package;
use App\Models\PackageType;
use App\Models\Property;
use App\Models\Services;
use App\Models\Vehicle;
use App\Models\Workoverseas;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class adsPosttController extends Controller
{
    public function mainAdsPost(Request $request)
    {
        app()->setlocale(Session::get('locale'));
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
            'cat_id' => $request->catId ?? null,
            'sub_cat_id' => $request->subcatId ?? null,
            'bump_up_at' => Carbon::now(),
            'user_id' => $request->userId ?? null,
            'ads_package' => $request->ads_package ?? null,
            'package_type' => $request->package_type ?? null,
            'package_expire_at' => $request->package_expire_at ?? null,
            'status' => 0,
        ]);

        // Create a new Ads instance and save to database
        if (Ads::create($adsData)) {
            if ($category->url === 'electronics') {
                $this->electronicdevices($adsId, $request->condition ?? null, $request->brand ?? null, $request->model ?? null, $request->specialization ?? null, $request->type ?? null, $request->screen_size ?? null, $request->capacity ?? null);
            }
            if ($category->url === 'vehicles') {
                $this->vehicle($adsId, $request->condition ?? null, $request->brand ?? null, $request->model ?? null, $request->type ?? null, $request->manufacture_year ?? null, $request->engine_capacity ?? null, $request->gears_up ?? null, $request->fragment_type ?? null, $request->Mileage ?? null, $request->edition ?? null, $request->model_year ?? null, $request->fuel_Type ?? null, $request->transmission ?? null);
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
            if ($category->url === 'business-and-industry') {
                $this->businessAndIndustry($adsId, $request->type ?? null, $request->status ?? null);
            }
            if ($category->url === 'hobbysportsandkids') {
                $this->hobbySportAndKids($adsId, $request->type ?? null, $request->status ?? null);
            }
            if ($category->url === 'fashionandbeauty') {
                $this->fashionAndBeauty($adsId, $request->type ?? null, $request->status ?? null);
            }
            if ($category->url === 'essentials') {
                $this->essentials($adsId, $request->type ?? null, $request->status ?? null);
            }
            if ($category->url === 'education') {
                $this->education($adsId, $request->type ?? null, $request->status ?? null);
            }
            if ($category->url === 'agriculture') {
                $this->agriculture($adsId);
            }
            if ($category->url === 'workoverseas') {
                $this->workOverseas($adsId,$request->industry ?? null,$request->type ?? null,$request->apply_via ?? null,$request->company_web ?? null,$request->application_deadline ?? null,$request->study_area ?? null,$request->university ?? null,$request->study_destination ?? null);
            }
            if ($category->url === 'workoverseas') {
                $this->workOverseas($adsId,$request->industry ?? null,$request->type ?? null,$request->apply_via ?? null,$request->company_web ?? null,$request->application_deadline ?? null,$request->study_area ?? null,$request->university ?? null,$request->study_destination ?? null);
            }
            if ($category->url === 'homeandgarden') {
                $this->homeAndGarden($adsId,$request->type ?? null,$request->status ?? null,$request->brand ?? null);
            }
        }

        // Pass data to the view
        return view('web.user.post-ads', [
            'catId' => $request->catId,
            'subcatId' => $request->subcatId,
            'maincategoryurl' => $categoryUrls[$request->catId],
            'subcategoryurl' => $categoryUrls[$request->subcatId],
            'brands' => $brands,
            'types' => $types,
            'plans' => $plans,
            'cities' => $this->fetchCities(),
            'districts' => $this->fetchDistricts(),
        ]);
    }

    private function electronicdevices($ad_id, $condition, $brand, $model, $specialization, $type, $sreeen_size, $capacity)
    {
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
    //vehicle
    private function vehicle($adsId, $condition, $brand, $model, $type, $manufacture_year, $engine_capacity, $gears_up, $fragment_type, $Mileage, $edition, $model_year, $fuel_Type, $transmission)
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
            'status' => $status,
        ];
        BusinessAndIndustry::create($adsData);
    }
    //hobby,sports and kids
    private function hobbySportAndKids($adsId, $type, $status)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'status' => $status,
        ];
        HobbySportsAndKids::create($adsData);
    }
    //Fashion and Beauty
    private function fashionAndBeauty($adsId, $type, $status)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'status' => $status,
        ];
        FashionAndBeauty::create($adsData);
    }
    //Essentials
    private function essentials($adsId, $type, $status)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'status' => $status,
        ];
        Essentials::create($adsData);
    }
    //Education
    private function education($adsId, $type, $status)
    {
        $adsData = [

            'adsId' => $adsId,
            'type' => $type,
            'status' => $status,
        ];
        Education::create($adsData);
    }
    //Agriculture
    private function agriculture($adsId)
    {
        $adsData = [

            'adsId' => $adsId,

        ];
        Agriculture::create($adsData);
    }
     //Work overseas
     private function workOverseas($adsId,$industry,$type,$apply_via,$company_web,$application_deadline,$study_area,$university,$study_destination)
     {
         $adsData = [

             'adsId' => $adsId,
             'industry'=>$industry,
             'type'=>$type,
             'apply_via'=>$apply_via,
             'company_web'=>$company_web,
             'application_deadline'=>$application_deadline,
             'study_area'=>$study_area,
             'university'=>$university,
             'study_destination'=>$study_destination,


         ];
         Workoverseas::create($adsData);
     }
     //Home and garden
     private function homeAndGarden($adsId,$type,$status,$brand)
     {
         $adsData = [

             'adsId' => $adsId,
             'type' => $type,
             'status' => $status,
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
            'mobilephones' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
            ],
            'tvandvideoaccessories' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'mobilephoneaccessories' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'computersandtablets' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'computeraccessories' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'audioandmp3' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'videogamesandconsoles' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'airconditionersandelectronicappliances' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'electronicappliances' => [
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'camerasandcamcorders' => [
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
                'edition' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
                'fuel_Type' => 'required|numeric|not_in:0',

                'transmission' => 'required|numeric|not_in:0',

            ],
            'bicycle' => [
                'brand' => 'required|numeric|not_in:0',

            ],
            'threewheel' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'model_year' => 'required|numeric|not_in:0',
                'edition' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
            ],
            'vans' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required|numeric|not_in:0',
                'model_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'buses' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required|numeric|not_in:0',
                'model_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
            ],
            'lorryandtrucks' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required|numeric|not_in:0',
                'model_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
            ],
            'heavyduty' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required|numeric|not_in:0',
                'model_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
            ],
            'tractors' => [
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
                'edition' => 'required|numeric|not_in:0',
                'model_year' => 'required|numeric|not_in:0',
                'Mileage' => 'required|numeric|not_in:0',
                'engine_capacity' => 'required|numeric|not_in:0',
            ],
            'autoservice' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'rentals' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'autopartsaccessories' => [
                'type' => 'required|numeric|not_in:0',
                'brand' => 'required|numeric|not_in:0',
                'model' => 'required|numeric|not_in:0',
            ],
            'maintainerandrepair' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'landforsale' => [

                'size_of_land' => 'required|numeric|not_in:0',
                'unit' => 'required|numeric|not_in:0',
                'address' => 'required',
            ],
            'haousesforsale' => [
                'rooms' => 'required|numeric|not_in:0',
                'bathrooms' => 'required|numeric|not_in:0',
                'size_of_land' => 'required|numeric|not_in:0',
                'size_sf' => 'required|numeric|not_in:0',
                'unit' => 'required|numeric|not_in:0',
                'address' => 'required',
            ],
            'apartmentsforsale' => [
                'rooms' => 'required|numeric|not_in:0',
                'bathrooms' => 'required|numeric|not_in:0',

                'size_sf' => 'required|numeric|not_in:0',

                'address' => 'required',
            ],
            'commercialpropertyforsale' => [
                'type' => 'required|numeric|not_in:0',
                'size_of_land' => 'required|numeric|not_in:0',
                'address' => 'required',

            ],
            'commercialpropertyforsale' => [
                'type' => 'required|numeric|not_in:0',
                'size_of_land' => 'required|numeric|not_in:0',
                'address' => 'required',

            ],
            'pets' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'farmanimals' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'tradeservice' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'domestricservices' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'eventandentertaiment' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'healthandwellbing' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'travelandtourism' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'otherservices' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'otherbusinessservices' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'musicalinstruments' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'sportsfitness' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'traveleventstickets' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'musicbooksmovies' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'childrensitems' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'clothing' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'shoesfootware' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'beautyproducts' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'grocery' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'meatandseafood' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'babyproducts' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'household' => [
                'type' => 'required|numeric|not_in:0',
            ],
            'overseasjobs'=>[
                'industry'=> 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
                'apply_via'=>'required',
            ],
            'studyworkabroad'=>[
                'study_area'=>'required',
                'apply_via'=>'required',
                'study_destination'=>'required',
            ],
            'furniture'=>[
                'brand' => 'required|numeric|not_in:0',
                'type' => 'required|numeric|not_in:0',
            ],
            'bathroomsanitaryware'=>[

                'type' => 'required|numeric|not_in:0',
            ],
            'buildingmaterialtools'=>[
                'type' => 'required|numeric|not_in:0',
            ],
            'garden'=>[

                'type' => 'required|numeric|not_in:0',
            ],
            'homedecor'=>[

                'type' => 'required|numeric|not_in:0',
            ],
            'kitchenitems'=>[

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
