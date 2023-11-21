<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Jobs\SendOtpJob;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // Validate the user
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:255'],
        ]);

        // Create and save the user
        $user = User::create($attributes);

        for ($i = 0; $i < 50; $i++) {
            dispatch(new SendMail($user, (object) $request->all()));
        }

        // Redirect
        return redirect()->back()->with('success', 'Your account has been created.');
    }

    public function sendOtp()
    {
        dispatch(new SendOtpJob())->onQueue('high');
        return redirect()->back()->with('success', 'OTP has been sent to your email.');
    }
}
