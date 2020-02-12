<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $categoryId =request()->input('category_id');//to get the category id from request method by request() this helper
        // $categoryId =$request>input('category_id');//to get the category id from request method



   //secind method     // $categoryId =request()->get('category_id');
        //third method // $categoryId =request()->category_id;


        if(!empty($categoryId)){
            $allProduct=Product::where('category_id',$categoryId)->get();//fetch products with selected category

        }
        else{
            $allProduct=Product::get();//fetch products with selected category

        }
        return view('home' ,compact('allProduct'));
    }
}
