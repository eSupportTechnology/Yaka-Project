<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
   public function index()
   {
       return view('adminPanel.dashboard');
   }
}
