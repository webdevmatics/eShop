<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {

        // $categoryId = request()->input('category_id');  //get category id from url
        $categoryId = $request->input('category_id');  //get category id from url


        // $categoryId = request()->get('category_id');
        // $categoryId = request()->category_id;

        if (!empty($categoryId)) {
            $allProducts = Product::where('category_id', $categoryId)->get();  //query to fetch products with selected category
        } else {
            $allProducts = Product::get();
        }


        return view('home', compact('allProducts'));
    }
}
