<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function checkout()
    {
        $cartItems = session('cartItems');

        $address = auth()->user()->address;


        return view('checkout', compact('cartItems', 'address'));
    }
}
