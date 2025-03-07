<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $step = session('registration_step', 1);
        $data = session('registration_data', []);
        return view('auth.register', compact('step', 'data'));
    }

    public function step1(Request $request)
    {
        if ($request->input('action') === 'next') {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(session('registration_data.id'))],
            ]);

            session(['registration_data' => array_merge(
                session('registration_data', []),
                $validatedData
            )]);
            session(['registration_step' => 2]);
        }

        return redirect()->route('register');
    }

    public function step2(Request $request)
    {
        if ($request->input('action') === 'previous') {
            session(['registration_step' => 1]);
        } elseif ($request->input('action') === 'next') {
            $validatedData = $request->validate([
                'phone' => ['required', 'string', 'max:20'],  // Changed to 'required'
                'address' => ['required', 'string', 'max:500'],  // Changed to 'required'
            ]);

            session(['registration_data' => array_merge(
                session('registration_data', []),
                $validatedData
            )]);
            session(['registration_step' => 3]);
        }

        return redirect()->route('register');
    }

    public function step3(Request $request)
    {
        if ($request->input('action') === 'previous') {
            session(['registration_step' => 2]);
            return redirect()->route('register');
        }

        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $registrationData = session('registration_data', []);
        
        // Check if all required data is present
        if (!isset($registrationData['name']) || !isset($registrationData['email']) || 
            !isset($registrationData['phone']) || !isset($registrationData['address'])) {
            return redirect()->route('register')->withErrors(['message' => 'Registration data is incomplete. Please start over.']);
        }

        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'phone' => $registrationData['phone'],
            'address' => $registrationData['address'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Clear registration session data
        session()->forget(['registration_step', 'registration_data']);

        // Log the user in
        auth()->login($user);

        return redirect()->route('welcome')->with('success', 'Registration successful! Welcome to Geraimu.');
    }
}

