<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allProducts = Product::all();
        $allProducts = Product::get();

        return view('products.index', ['products'=> $allProducts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add validation

        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'cover_img'=>'required|image'
        ]);

        //store in database
            $product = new Product();
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->description = $request->input('description');

            // check if file is present
            if($request->has('cover_img')) {
                //store file in disk
                $filePath = $request->file('cover_img')->store('products');
                //saving file in database
                $product->cover_img = $filePath;
            }

            $product->save();

        //redirect to index page

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return view('products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //add validation

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'cover_img' => 'required|image'
        ]);

        //store in database
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');


        // check if file is present
        if ($request->has('cover_img')) {

            Storage::delete($product->cover_img); // delete old files

            //store file in disk
            $filePath = $request->file('cover_img')->store('products');
            //saving file in database
            $product->cover_img = $filePath;

        }


        $product->save();

        //redirect to index page

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        Storage::delete($product->cover_img); // delete old files

        return redirect()->route('products.index');

    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        $cart = new addToCart();
        $cart->product_name = $product->name;
        $cart->price = $product->price;
        $cart->user_id = auth()->user()->id;

        $cart->save();

    }

}
