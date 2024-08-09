<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\DistributorPIC;
use App\Models\User;

class DistributorPICController extends Controller
{
    public function index($id)
    {
        $distributor = Distributor::with('principals')->findOrFail($id);
        $distributorPICs = DistributorPIC::where('Distributor_Name', '=', $distributor->ID_Distributor)->get();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();

        return view('distributor.pic', compact('distributor', 'distributorPICs', 'superAdmins'));
    }

    public function store(Request $request, $id)
    {
        $distributor = Distributor::findOrFail($id);

        $request->validate([
            'DistPIC_Name' => 'required|string|max:200',
            'DistPIC_JobPosition' => 'required|string',
            'DistPIC_Phone' => 'required|numeric',
            'DistPIC_Email' => 'nullable|email|max:200',
        ]);

        DistributorPIC::create([
            'Distributor_Name' => $distributor->ID_Distributor,
            'DistPIC_Name' => $request->DistPIC_Name,
            'DistPIC_JobPosition' => $request->DistPIC_JobPosition,
            'DistPIC_Phone' => $request->DistPIC_Phone,
            'DistPIC_Email' => $request->DistPIC_Email,
        ]);

        return redirect()->route('distributor.pic', $id)->with('success', 'Distributor PIC berhasil ditambahkan.');
    }

    public function destroy($id, $Distributor_PIC_ID)
    {
        $distributor = Distributor::findOrFail($id);
        $pic = DistributorPIC::where('Distributor_Name', '=', $distributor->ID_Distributor)
                            ->where('Distributor_PIC_ID', '=', $Distributor_PIC_ID)
                            ->first();

        if ($pic) {
            $pic->delete();
            return redirect()->route('distributor.pic', $id)->with('success', 'Distributor PIC berhasil dihapus.');
        }

        return redirect()->route('distributor.pic', $id)->with('error', 'Distributor PIC tidak ditemukan.');
    }
}
