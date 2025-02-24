<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FormField;

class FormFieldsController extends Controller
{


    public function index(Request $request)
    {
        $mainCategories = Category::where('mainId', 0)->get();
        $formFieldsQuery = FormField::with('subcategory');
        
        if ($request->has('main_category_id') && $request->input('main_category_id') != '') {
            $mainCategoryId = $request->input('main_category_id');
            $formFieldsQuery->whereHas('subcategory', function($query) use ($mainCategoryId) {
                $query->where('mainId', $mainCategoryId);
            });
        }

        $formFields = $formFieldsQuery->paginate(10);
    
        $formFieldsGrouped = $formFields->getCollection()->groupBy('subcategory_id');
    
        return view('newAdminDashboard.formfieldsManagement.index', compact('formFieldsGrouped', 'mainCategories', 'formFields'));
    }
    
    

    public function create()
    {
        $mainCategories = Category::where('mainId', 0)->get(); 
        return view('newAdminDashboard.formfieldsManagement.create', compact('mainCategories'));
    }

    
    public function getSubcategories($mainCategoryId)
    {
        $subcategories = Category::where('mainId', $mainCategoryId)->get();
        return response()->json($subcategories);
    }


    public function store(Request $request)
    {
        $request->validate([
            'main_category' => 'required|string',
            'subcategory' => 'required|string',
            'field_name' => 'required|array',
            'field_type' => 'required|array',
            'field_name.*' => 'required|string',
            'field_type.*' => 'required|string',
        ]);
    
        // Loop through each field and create a new FormField entry
        foreach ($request->field_name as $index => $fieldName) {
            FormField::create([
                'main_category_id' => $request->main_category,
                'subcategory_id' => $request->subcategory,
                'field_name' => $fieldName,
                'field_type' => $request->field_type[$index],
            ]);
        }
    
        return redirect()->route('dashboard.form_fields')->with('success', 'Fields saved successfully.');
    }
    

    public function destroy($id)
    {
        $formField = FormField::findOrFail($id);
        $formField->delete();
    
        return redirect()->route('dashboard.form_fields')->with('success', 'Field deleted successfully.');
    }
    
}
