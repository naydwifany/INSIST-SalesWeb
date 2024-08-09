<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Distributor;
use App\Models\Principal;
use App\Models\User;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();

        // Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'You need to login to open this page.');
        }

        $userPosition = Auth::user()->UserPosition;
        $distributors = Distributor::with('pics','brands')->get();
        $distributors = Distributor::orderBy('Distributor_Name')->get();
        $principals = Principal::all();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();
        return view('distributor.index', compact('distributors', 'principals', 'userPosition', 'superAdmins'));
    }

    public function getPrincipal()
    {
        $principals = Principal::all();
        return response()->json($principals);
    }

    public function getDistributor(Request $request)
    {
        $distributor = Distributor::with('brands')->find($request->id);
    
        if ($distributor) {
            $brands = $distributor->brands->map(function ($principal) {
                return [
                    'ID_Principal' => $principal->ID_Principal,
                    'Brand' => $principal->Brand
                ];
            });
    
            return response()->json([
                'ID_Distributor' => $distributor->ID_Distributor,
                'Distributor_Name' => $distributor->Distributor_Name,
                'TaxID_Distributor' => $distributor->TaxID_Distributor,
                'brands' => $brands
            ]);
        }
    
        return response()->json(['error' => 'Distributor not found'], 404);
    }    

    public function addDistributor(Request $request)
    {
        $distributor = new Distributor();
        $distributor->Distributor_Name = $request->Distributor_Name;
        $distributor->TaxID_Distributor = $request->TaxID_Distributor;
        $distributor->save();

        $distributor->brands()->sync($request->Brand); // Sync the brands

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $distributor = new Distributor();
        $distributor->Distributor_Name = $request->Distributor_Name;
        $distributor->TaxID_Distributor = $request->TaxID_Distributor;
        $distributor->save();

        $distributor->brands()->sync($request->Brand); // Sync the brands

        return redirect()->route('distributor.index')->with('success', 'Distributor added successfully.');
    }    

    public function update(Request $request, $id)
    {
        $distributor = Distributor::findOrFail($id);
    
        $request->validate([
            'Distributor_Name' => 'required|string|max:200',
            'TaxID_Distributor' => 'nullable|string|max:20',
            'Brand' => 'required|array',
            'Brand.*' => 'exists:principals,ID_Principal',
        ]);
    
        $distributor->update([
            'Distributor_Name' => $request->Distributor_Name,
            'TaxID_Distributor' => $request->TaxID_Distributor,
        ]);
    
        $distributor->brands()->sync($request->Brand);
    
        return redirect()->route('distributor.index')->with('success', 'Distributor updated successfully.');
    }    

    public function destroy($id)
    {
        Distributor::findOrFail($id)->delete();

        return redirect()->route('distributor.index')->with('success', 'Distributor deleted successfully.');
    }

    public function show($id)
    {
        $distributor = Distributor::with('brands')->find($id);
    
        if ($distributor) {
            return response()->json([
                'ID_Distributor' => $distributor->ID_Distributor,
                'Distributor_Name' => $distributor->Distributor_Name,
                'TaxID_Distributor' => $distributor->TaxID_Distributor,
                'Brands' => $distributor->brands // Return brands related to the distributor
            ]);
        }
    }    

    public function showDistributorPIC($id)
    {
        // Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'You need to login to open this page.');
        }

        $distributor = Distributor::with('pics','brands')->findOrFail($id);
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();

        // Periksa apakah user memiliki izin untuk mengakses halaman ini
        $userPosition = Auth::user()->UserPosition;
        if (!in_array($userPosition, ['Super Admin', 'Admin/Finance'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('distributor.pic', [
            'distributor' => $distributor,
            'userPosition' => $userPosition,
            'superAdmins' => $superAdmins
        ]);
    }
}