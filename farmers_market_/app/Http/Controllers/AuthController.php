<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);

        $credentials = $request->only('Email', 'Password');

        // Find user by email
        $user = User::where('Email', $credentials['Email'])->first();

        if ($user && (Hash::check($credentials['Password'], $user->Password) || $credentials['Password'] === $user->Password)) {
            Auth::login($user);
            // Store username and id in session
            session(['username' => $user->FullName, 'user_id' => $user->UserID]);
            
            if ($user->Role == 'Farmer') {
                return redirect()->route('farmer.dashboard');
            } elseif ($user->Role == 'Buyer') {
                return redirect()->route('buyer.dashboard');
            } else {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors(['Email' => 'Invalid credentials']);
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'FullName' => 'required',
            'Email' => 'required|email|unique:users',
            'Phone' => 'nullable|string',
            'Password' => 'required|min:6',
            'Gender' => 'nullable|in:Male,Female,Other',
            'FarmName' => 'nullable|string',
            'Role' => 'required|in:Farmer,Buyer',
            'About' => 'required|string',
        ]);

        User::create([
            'FullName' => $request->FullName,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'Phone' => $request->Phone,
            'Gender' => $request->Gender,
            'FarmName' => $request->FarmName,
            'Role' => $request->Role,
            'About' => $request->About,
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    
}
