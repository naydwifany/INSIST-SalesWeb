<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Principal;
use App\Models\User;
use App\Models\Sale;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = Product::query();
    
        if ($search) {
            $products = $products->where('Product_Name', 'LIKE', "%{$search}%");
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'You need to login to open this page.');
        }

        $sales = Sale::with(['client', 'clientPic', 'user', 'distributor', 'brand'])->get();
        $products = $products->orderBy('Product_Name')->get();
        $productsSortedById = Product::orderBy('ID_Product')->get();
        $categories = ['Hardware', 'License', 'Guarantee', 'Service', 'Training'];
        $principals = Principal::orderBy('Brand')->get();
        $superAdmins = User::where('UserPosition', 'Super Admin')->orderBy('NameUser')->get();

        if ($request->ajax()) {
            return view('product.partials.product_table', compact('products'))->render();
        }

        return view('product', compact('products', 'categories', 'productsSortedById', 'principals', 'superAdmins', 'sales'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Product_Name' => 'required|string|max:200',
            'Brand' => 'required|exists:principals,ID_Principal',
            'Product_Type' => 'nullable|string|max:200',
            'Product_Spec' => 'nullable|string|max:200',
            'Category' => 'required|string|in:Hardware,License,Guarantee,Service,Training'
        ]);

        try {
            Product::create($validatedData);
            return back()->with('message', 'Data has been created');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create data: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'Product_Name' => 'required|string|max:200',
            'Brand' => 'required|exists:principals,ID_Principal',
            'Product_Type' => 'nullable|string|max:200',
            'Product_Spec' => 'nullable|string|max:200',
            'Category' => 'required|string|in:Hardware,License,Guarantee,Service,Training'
        ]);

        $product->update($request->all());

        return redirect()->route('product')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('product')->with('success', 'Product deleted successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}
