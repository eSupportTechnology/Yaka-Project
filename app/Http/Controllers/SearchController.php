<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Replace 'Item' with your actual model

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Check if query is not empty
        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        // Search in multiple columns
        $items = Item::where('title', 'LIKE', "%{$query}%")
                     ->orWhere('category_name', 'LIKE', "%{$query}%")
                     ->orWhere('sub_category_name', 'LIKE', "%{$query}%")
                     ->orWhere('district', 'LIKE', "%{$query}%")
                     ->get();

        return view('search-results', compact('items', 'query'));
    }
}

