<?php

namespace App\Http\Controllers\staffPanel;

use App\Models\Ads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class staffManagementController extends Controller
{
    public function index(){
        $users = User::where('roles',  'staff')->select('id', 'first_name', 'last_name', 'url', 'email', 'status')->paginate(10);

        return view('newAdminDashboard.staffManagement.index', ['users' => $users]);
    }

    public function create()
    {
        $users = User::where('status','1')->select('id', 'first_name', 'last_name')->get();

        return view('newAdminDashboard.staffManagement.create',['users' => $users]);
    }

    public function store(Request $request)
    {
        $users = User::where('status', '1')
            ->select('id', 'first_name', 'last_name')->get();

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|min:8',
        ]);

        $url = strtolower($validatedData['first_name'] . '-' . $validatedData['last_name']);
        $url = preg_replace('/[^a-z0-9\-]/', '', $url);
        $url = preg_replace('/-+/', '-', $url);

        $user = new User();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->phone_number = $validatedData['number'];
        $user->roles = $request['role'];
        $user->url = $url;
        $user->status = '1';
        $user->password = Hash::make($validatedData['password']);

        $user->save();

        return view('newAdminDashboard.staffManagement.create',['users' => $users])->with('usersuccess', $request['role'].' created successfully.');
    }

    public function view($id)
    {
        $user = User::find($id);
        $userAds = Ads::where('created_by_staff_id', $id)->get();
        $totalAds = $userAds->count();
        $adsDetails = DB::select("select a.cat_id, count(1) as total, c.name from ads a join categories c on c.id=a.cat_id where a.created_by_staff_id =$id group by a.cat_id order by a.cat_id ASC");
        return view('newAdminDashboard.staffManagement.view',['user' => $user, 'totalAds' => $totalAds, 'adsDetails' => $adsDetails]);
    }

    public function update($id)
    {
        $user = User::find($id);
        return view('newAdminDashboard.staffManagement.update',['user' => $user]);
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->user);

        if (!$user) {
            return view('newAdminDashboard.staffManagement.update',['user' => $user])->with('unsuccess', 'User not found.');
        }

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $url = strtolower($validatedData['first_name'] . '-' . $validatedData['last_name']);
        $url = preg_replace('/[^a-z0-9\-]/', '', $url);
        $url = preg_replace('/-+/', '-', $url);

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->url = $url;
        $user->phone_number = $validatedData['phone_number'];
        $user->save();

        return view('newAdminDashboard.staffManagement.update',['user' => $user])->with('success', 'User updated successfully.');
    }
    public function delete($id)
    {
        $user = User::find($id);
        return view('newAdminDashboard.staffManagement.delete',['user' => $user]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('dashboard.staffs')->with('success', 'User deleted successfully.');
    }
}
