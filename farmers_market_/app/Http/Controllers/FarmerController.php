<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Support;

class FarmerController extends Controller
{
    public function dashboard()
    {
        $farmer_id = Auth::id();
        $farmer_name = Auth::user()->FullName ?? 'Farmer';
    }
}
