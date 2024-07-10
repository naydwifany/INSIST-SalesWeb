<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;
use App\Models\PrincipalPIC;

class PrincipalPICController extends Controller
{
    public function index($brand)
    {
        // Menggunakan tanda kutip di sekitar nilai brand
        $principalPICs = PrincipalPIC::where('Brand', '=', $brand)->get();
        $principal = Principal::where('Brand', $brand)->first();
        return view('principal.pic', compact('principal', 'principalPICs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'PrincipalName' => 'required|string|max:200',
            'PrincipalJobPosition' => 'required|string',
            'PrincipalPhone' => 'required|numeric',
            'PrincipalEmail' => 'nullable|email|max:200',
            'Brand' => 'required|string'
        ]);

        PrincipalPIC::create($request->all());
        return redirect()->route('principal-pic.index', $request->Brand);
    }

    public function destroy($id)
    {
        $principalPIC = PrincipalPIC::find($id);
        $brand = $principalPIC->Brand;
        $principalPIC->delete();
        return redirect()->route('principal-pic.index', $brand);
    }
}