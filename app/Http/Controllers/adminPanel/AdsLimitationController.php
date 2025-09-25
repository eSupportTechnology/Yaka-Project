<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use App\Models\AdsLimitation;
use Illuminate\Http\Request;

class AdsLimitationController extends Controller
{
    public function index()
    {
        $adsLimitations = AdsLimitation::all();
        return view('newAdminDashboard.adsLimitations.index', compact('adsLimitations'));
    }

    public function create()
    {
        return view('newAdminDashboard.adsLimitations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'limit' => 'required|integer|min:0',
            'status' => 'required|in:0,1'
        ]);

        AdsLimitation::create([
            'name' => $request->name,
            'limit' => $request->limit,
            'status' => $request->status
        ]);

        return redirect()->route('dashboard.limit.index')->with('success', 'Ads Limitation created successfully!');
    }

    public function edit($id)
    {
        $adsLimitation = AdsLimitation::findOrFail($id);
        return view('newAdminDashboard.adsLimitations.edit', compact('adsLimitation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'limit' => 'required|integer|min:0',
            'status' => 'required|in:0,1'
        ]);

        $adsLimitation = AdsLimitation::findOrFail($id);
        $adsLimitation->update([
            'name' => $request->name,
            'limit' => $request->limit,
            'status' => $request->status
        ]);

        return redirect()->route('dashboard.limit.index')->with('success', 'Ads Limitation updated successfully!');
    }

    public function destroy($id)
    {
        $adsLimitation = AdsLimitation::findOrFail($id);
        $adsLimitation->delete();

        return redirect()->route('dashboard.limit.index')->with('success', 'Ads Limitation deleted successfully!');
    }
}
