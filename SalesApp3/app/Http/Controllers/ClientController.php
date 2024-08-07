<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $clients = Client::query();
    
        if ($search) {
            $clients = $clients->where('Client_Name', 'LIKE', "%{$search}%");
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'You need to login to open this page.');
        }

        $userPosition = Auth::user()->UserPosition;
        $clients = $clients->with('pics')->orderBy('Client_Name')->get();
        $users = User::orderBy('NameUser')->get();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();
        $categories = ['Financial Service Industry', 'Government', 'Hospital', 'Education', 'Hotel', 'Military', 'Private'];

        if ($request->ajax()) {
            return view('client.partials.client_table', compact('clients'))->render();
        }

        return view('client.index', compact('clients', 'users', 'userPosition', 'categories', 'superAdmins'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Client_Name' => 'required|string|max:200',
            'Client_Address' => 'required|string|max:200',
            'NameUser' => 'required|exists:users,ID_User',
            'Category' => 'required|string|in:Financial Service Industry,Government,Hospital,Education,Hotel,Military,Private',
            'Client_TaxID' => 'nullable|string|max:20',
            'Bandwidth' => 'nullable|string|max:200',
            'TotalEndpoint' => 'nullable|integer',
            'DataCenterModel' => 'nullable|string|max:20',
            'ConcurrentUser' => 'nullable|integer',
            'InternalNotes' => 'nullable|string|max:200'
        ]);

        try {
            Client::create($validatedData);
            return back()->with('message', 'Data has been created');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create data: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'Client_Name' => 'required|string|max:200',
            'Client_Address' => 'required|string|max:200',
            'NameUser' => 'required|exists:users,ID_User',
            'Category' => 'required|string|in:Financial Service Industry,Government,Hospital,Education,Hotel,Military,Private',
            'Client_TaxID' => 'nullable|string|max:20',
            'Bandwidth' => 'nullable|string|max:200',
            'TotalEndpoint' => 'nullable|integer',
            'DataCenterModel' => 'nullable|string|max:20',
            'ConcurrentUser' => 'nullable|integer',
            'InternalNotes' => 'nullable|string|max:200'
        ]);

        $client->update($request->all());

        return redirect()->route('client.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
    }

    public function show($id)
    {
        $client = Client::with('pics')->findOrFail($id);
        return response()->json($client);
    }

    public function showClientPIC($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'You need to login to open this page.');
        }

        $client = Client::with('pics')->findOrFail($id);

        $userPosition = Auth::user()->UserPosition;
        if (!in_array($userPosition, ['Super Admin', 'Admin/Finance', 'Sales', 'Manager'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.pic', [
            'client' => $client,
            'userPosition' => $userPosition
        ]);
    }
}