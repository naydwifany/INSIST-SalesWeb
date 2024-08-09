<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->UserStatus !== 'Approve') {
            Auth::logout();
            return redirect('/login')->with('error', 'You must be approved to access this page.');
        }

        $users = User::orderBy('NameUser')->where('UserPosition', '!=', 'Super Admin')->get();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();
        return view('homepage', compact('user', 'users','superAdmins'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}