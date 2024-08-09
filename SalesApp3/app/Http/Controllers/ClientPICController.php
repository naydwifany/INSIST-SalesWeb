<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientPIC;

class ClientPICController extends Controller
{
    public function index($id)
    {
        $client = Client::with('user')->findOrFail($id);
        $clientPICs = ClientPIC::where('Client_Name', '=', $client->ID_Client)->get();

        return view('client.pic', compact('client', 'clientPICs'));
    }

    public function store(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'ClientPIC_Name' => 'required|string|max:200',
            'ClientPIC_JobPosition' => 'required|string|max:200',
            'ClientPIC_Phone' => 'required|numeric',
            'ClientPIC_Email' => 'nullable|email|max:200',
        ]);

        ClientPIC::create([
            'Client_Name' => $client->ID_Client,
            'ClientPIC_Name' => $request->ClientPIC_Name,
            'ClientPIC_JobPosition' => $request->ClientPIC_JobPosition,
            'ClientPIC_Phone' => $request->ClientPIC_Phone,
            'ClientPIC_Email' => $request->ClientPIC_Email,
        ]);

        return redirect()->route('client.pic', $id)->with('success', 'Client PIC berhasil ditambahkan.');
    }

    public function destroy($id, $Client_PIC_ID)
    {
        $client = Client::findOrFail($id);
        $pic = ClientPIC::where('Client_Name', '=', $client->ID_Client)
                            ->where('Client_PIC_ID', '=', $Client_PIC_ID)
                            ->first();

        if ($pic) {
            $pic->delete();
            return redirect()->route('client.pic', $id)->with('success', 'Client PIC berhasil dihapus.');
        }

        return redirect()->route('client.pic', $id)->with('error', 'Client PIC tidak ditemukan.');
    }
}
