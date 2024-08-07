<?php

namespace App\Http\Controllers;

use App\Models\Principal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PrincipalController extends Controller
{
    public function index()
    {
        $principals = Principal::all();
        $userPosition = Auth::user()->UserPosition;
        $principals = Principal::with('pics')->get();
        $principals = Principal::orderBy('Brand')->get();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();
        return view('principal.index', compact('principals', 'userPosition', 'superAdmins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Brand' => 'required|string|max:200|unique:principals',
            'PrincipalAddress' => 'required|string|max:200',
        ]);
    
        Principal::create($request->only(['Brand', 'PrincipalAddress']));
    
        return redirect()->route('principal.index')->with('success', 'Principal added successfully.');
    }    

    public function update(Request $request, $id)
    {
        $principal = Principal::findOrFail($id);

        $request->validate([
            'Brand' => 'required|string|max:200|unique:principals,Brand,' . $principal->ID_Principal . ',ID_Principal',
            'PrincipalAddress' => 'required|string|max:200',
        ]);

        $principal->update($request->all());

        return redirect()->route('principal.index')->with('success', 'Principal updated successfully.');
    }

    public function destroy($id)
    {
        Principal::findOrFail($id)->delete();

        return redirect()->route('principal.index')->with('success', 'Principal deleted successfully.');
    }

    public function show($id)
    {
        $principal = Principal::with('pics')->findOrFail($id);
        return response()->json($principal);
    }

    public function showPrincipalPIC($id)
    {
        // Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'You need to login to open this page.');
        }

        $principal = Principal::with('pics')->findOrFail($id);

        // Periksa apakah user memiliki izin untuk mengakses halaman ini
        $userPosition = Auth::user()->UserPosition;
        if (!in_array($userPosition, ['Super Admin', 'Admin/Finance'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('principal-pic', [
            'principal' => $principal,
            'userPosition' => $userPosition
        ]);
    }
}