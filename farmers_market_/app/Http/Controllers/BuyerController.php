<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class BuyerController extends Controller
{
    public function dashboard(Request $request, $category = 'All')
    {
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');
    }
}
