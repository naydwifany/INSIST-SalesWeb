<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;
use App\Models\PrincipalPIC;
use App\Models\User;

class PrincipalPICController extends Controller
{
    public function index($id)
    {
        $principal = Principal::findOrFail($id);
        $principalPICs = PrincipalPIC::where('Brand', '=', $principal->ID_Principal)->orderBy('PrincipalName')->get();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();

        return view('principal.pic', compact('principal', 'principalPICs', 'superAdmins'));
    }

    public function store(Request $request, $id)
    {
        $principal = Principal::findOrFail($id);

        $request->validate([
            'PrincipalName' => 'required|string|max:200',
            'PrincipalJobPosition' => 'required|string',
            'PrincipalPhone' => 'required|numeric',
            'PrincipalEmail' => 'nullable|email|max:200',
            'Notes' => 'nullable|string|max:200',
        ]);

        PrincipalPIC::create([
            'Brand' => $principal->ID_Principal,  // Ensure it stores ID_Principal, not Brand
            'PrincipalName' => $request->PrincipalName,
            'PrincipalJobPosition' => $request->PrincipalJobPosition,
            'PrincipalPhone' => $request->PrincipalPhone,
            'PrincipalEmail' => $request->PrincipalEmail,
            'Notes' => $request->Notes,
        ]);

        return redirect()->route('principal.pic', $id)->with('success', 'Principal PIC berhasil ditambahkan.');
    }

    public function destroy($id, $Principal_PIC_ID)
    {
        $principal = Principal::findOrFail($id);
        $pic = PrincipalPIC::where('Brand', '=', $principal->ID_Principal)
                            ->where('Principal_PIC_ID', '=', $Principal_PIC_ID)
                            ->first();

        if ($pic) {
            $pic->delete();
            return redirect()->route('principal.pic', $id)->with('success', 'Principal PIC berhasil dihapus.');
        }

        return redirect()->route('principal.pic', $id)->with('error', 'Principal PIC tidak ditemukan.');
    }
}