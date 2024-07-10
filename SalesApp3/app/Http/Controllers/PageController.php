<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function principal()
    {
        return view('principal');
    }

    public function distributor()
    {
        return view('distributor');
    }

    public function client()
    {
        return view('client');
    }

    public function product()
    {
        return view('product');
    }

    public function sales()
    {
        return view('sales');
    }
}