<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Sale;
use App\Models\Principal;
use App\Models\Distributor;
use App\Models\Product;
use App\Models\Client;
use App\Models\ClientPIC;
use App\Models\User;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'You need to login to open this page.');
        }
    
        $userPosition = Auth::user()->UserPosition;
        $sales = Sale::orderBy('Sales_Date')->get();
        $clients = Client::orderBy('Client_Name')->get(); // Pastikan ini mengembalikan data yang diharapkan
        $users = User::orderBy('NameUser')->get();
        $brands = Principal::orderBy('Brand')->get();
        $products = Product::orderBy('Product_Name')->get();
        $distributors = Distributor::orderBy('Distributor_Name')->get();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();
    
        return view('sales', compact('userPosition', 'sales', 'clients', 'users', 'brands', 'products', 'superAdmins', 'distributors'));
    }

    public function create()
    {
        $clients = Client::all();
        $clientPics = ClientPIC::all();
        $users = User::all();
        $brands = Principal::all();
        $distributors = Distributor::all();
        $products = Product::all();
        
        return view('sales.create', compact('clients', 'clientPics', 'users', 'brands', 'distributors', 'products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Sales_Date' => 'required|date',
            'Client_Name' => 'required|exists:clients,ID_Client',
            'ClientPIC_Name' => 'required|exists:clientpics,Client_PIC_ID',
            'NameUser' => 'required|exists:users,ID_User',
            'Brand' => 'required|exists:principals,ID_Principal',
            'Distributor_Name' => 'required|exists:distributors,ID_Distributor',
            'Product_Name' => 'required|exists:products,ID_Product',
            'Category' => 'required|exists:products,ID_Product',
            'Quantity' => 'required|integer',
            'UnitPrice' => 'required|numeric',
            'TotalPrice' => 'required|numeric',
            'SerialNumber' => 'nullable|string|max:20',
            'ExpDate' => 'nullable|date',
            'ContractNumber' => 'nullable|string|max:200',
            'SalesNotes' => 'nullable|string|max:200',
        ]);
    
        dd($validatedData); // Dump and die untuk melihat data yang sudah divalidasi
    }
    
    
    public function update(Request $request, Sale $sales)
    {
        $request->validate([
            'Sales_Date' => 'required|date',
            'Client_Name' => 'required|exists:clients,ID_Client',
            'ClientPIC_Name' => 'required|exists:clientpics,Client_PIC_ID',
            'NameUser' => 'required|exists:users,ID_User',
            'Brand' => 'required|exists:principals,ID_Principal',
            'Distributor_Name' => 'required|exists:distributors,ID_Distributor',
            'Product_Name' => 'required|exists:products,ID_Product',
            'Category' => 'required|exists:products,ID_Product',
            'Quantity' => 'required|integer',
            'UnitPrice' => 'required|numeric',
            'TotalPrice' => 'required|numeric',
            'SerialNumber' => 'nullable|string|max:20',
            'ExpDate' => 'nullable|date',
            'ContractNumber' => 'nullable|string|max:200',
            'SalesNotes' => 'nullable|string|max:200',
        ]);
    
        $sales->update($request->all());
    
        return response()->json(['message' => 'The data updated successfully.']);
    }
    
    public function destroy(Sale $sales)
    {
        $sales->delete();
        return response()->json(['message' => 'The data deleted successfully.']);
    }
    
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return response()->json($sale);
    }    

    public function getClientPICs($clientId)
    {
        $client = Client::with('user')->find($clientId);
        if ($client) {
            $clientPICs = ClientPIC::where('Client_Name', $clientId)->get();
            $nameUser = $client->user; // Mengambil NameUser dari relasi user
            return response()->json([
                'clientPICS' => $clientPICs,
                'nameUser' => $nameUser ? ['ID_User' => $nameUser->ID_User, 'NameUser' => $nameUser->NameUser] : null
            ]);
        } else {
            return response()->json(['clientPICS' => [], 'nameUser' => null]);
        }
    }      

    public function getDistributors($brandId)
    {
        $distributors = Distributor::whereHas('brands', function($query) use ($brandId) {
            $query->where('principals.ID_Principal', $brandId);
        })->get();
    
        return response()->json([
            'distributors' => $distributors
        ]);
    }      

    public function getProducts($brandId)
    {
        // Mendapatkan produk berdasarkan Brand yang merujuk pada ID_Principal
        $products = Product::where('Brand', $brandId)->get();
    
        return response()->json([
            'products' => $products,
        ]);
    }
    

    public function getCategory($productId)
    {
        $product = Product::find($productId);
        return response()->json(['Category' => $product->Category, 'ID_Product' => $product->ID_Product]);
    }
}