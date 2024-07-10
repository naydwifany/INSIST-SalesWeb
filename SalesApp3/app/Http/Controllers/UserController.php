<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Metode lain dalam UserController

    public function changeStatus(Request $request, $id)
    {
        // Validasi request jika diperlukan

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Ubah status user
        if ($user->UserStatus == 'Approve') {
            $user->UserStatus = 'Reject';
        } else {
            $user->UserStatus = 'Approve';
        }

        // Simpan perubahan
        $user->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->back()->with('success', 'User status has been changed successfully.');
    }
}