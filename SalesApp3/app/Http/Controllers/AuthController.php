<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        $userPositions = ['Admin/Finance', 'Sales', 'Technical', 'Manager']; // Opsi untuk UserPosition
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();

        return view('auth.signup', compact('userPositions', 'superAdmins'));
    }

    public function processSignup(Request $request)
    {
        // Validasi data dari form
        $validator = Validator::make($request->all(), [
            'NameUser' => 'required|string|max:200',
            'EmailUser' => 'required|string|email|max:200|regex:/@insist\.co\.id$/',
            'MobilePhoneUser' => 'required|numeric|digits_between:10,15',
            'SecurityQuestion' => 'required|string|max:200',
            'Answer' => 'required|string|max:200',
            'Password' => 'required|string|min:6|confirmed',
            'UserPosition' => 'required|string|in:Admin/Finance,Sales,Technical,Manager',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = new User();
        $user->NameUser = $request->NameUser;
        $user->EmailUser = $request->EmailUser;
        $user->MobilePhoneUser = $request->MobilePhoneUser;
        $user->SecurityQuestion = $request->SecurityQuestion;
        $user->Answer = $request->Answer;
        $user->Password = Hash::make($request->Password);
        $user->UserPosition = $request->UserPosition;
        $user->UserStatus = 'Reject'; // Default status
    
        $user->save();
    
        return redirect()->route('signup')->with('success', 'Your account has been successfully created.');
    }

    public function showLoginForm()
    {
        $userPositions = ['Admin/Finance', 'Sales', 'Technical', 'Manager']; // Opsi untuk UserPosition
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();

        return view('auth.login', compact('userPositions', 'superAdmins'));
    }

    public function processLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'EmailUser' => 'required|string|email|max:200|regex:/@insist\.co\.id$/',
            'Password' => 'required|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::where('EmailUser', $request->EmailUser)->first();
    
        if (!$user || !Hash::check($request->Password, $user->Password)) {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    
        if ($user->UserStatus === 'Reject') {
            $superAdmins = User::where('UserPosition', 'Super Admin')->pluck('NameUser')->toArray();
            $superAdminsList = implode(', ', $superAdmins);
            return redirect()->back()->with('error', "Your account cannot access the sales system website yet. Please ask for access from super admin: $superAdminsList.");
        }
    
        Auth::login($user);
    
        return redirect()->route('homepage');
    }      
    
    public function getUserPosition(Request $request)
    {
        $email = $request->query('email');
        $user = User::where('EmailUser', $email)->first();

        return response()->json([
            'position' => $user ? $user->UserPosition : null,
        ]);
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Process the forgot password form
    public function processForgotPassword(Request $request)
    {
        $request->validate(['EmailUser' => 'required|email']);

        $user = User::where('EmailUser', $request->EmailUser)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'This email is not registered.');
        }

        return redirect()->route('reset-password', ['email' => $request->EmailUser]);
    }

    // Show the reset password form
    public function showResetPasswordForm($email)
    {
        $user = User::where('EmailUser', $email)->first();

        if (!$user) {
            return redirect()->route('forgot-password')->with('error', 'This email is not registered.');
        }

        return view('auth.reset-password', ['email' => $email, 'securityQuestion' => $user->SecurityQuestion]);
    }

    // Process the reset password form
    public function processResetPassword(Request $request)
    {
        $request->validate([
            'EmailUser' => 'required|email',
            'Answer' => 'required|string',
            'NewPassword' => 'required|string|min:6|confirmed',
        ]);
    
        $user = User::where('EmailUser', $request->EmailUser)->first();
    
        if (!$user || $user->Answer !== $request->Answer) {
            return redirect()->back()->with('error', 'Your answer is incorrect.');
        }
    
        $user->Password = $request->NewPassword; // Setter akan meng-hash password
        $user->save();
    
        return redirect()->route('login')->with('success', 'Your password has been changed.');
    }    
}