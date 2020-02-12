<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryId = request('category_id');//2
        // $allProducts = Product::all();
        // $allProducts = Product::paginate(10);

        // $productWithCategory = Product::orderBy('created_at','DESC')->paginate(10);

        $productWithCategory = Cache::remember('product-data-sgarne'.$categoryId, 60, function () use($categoryId) {
            return Product::where('category_id',$categoryId)->latest()->paginate(10);
        });

        // $productWithCategory = Product::latest()->paginate(10);

        return view('products.index', ['products'=> $productWithCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = Category::all()->pluck('name','id');


        return view('products.create',compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        //add validation
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            // 'cover_img'=>'required|image'
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

            $product->category_id = $request->input('category_id');

            $product->save();


            //remove cache

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

        $allCartItems = [];

        $newItemToAdd =  [
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => '1'
        ];

        if(session()->has('cartItems')) {
            $allCartItems = session()->get('cartItems');
        }

        //product already in cart
        if (isset($allCartItems[$productId])) {
            $allCartItems[$productId]['qty'] = $allCartItems[$productId]['qty'] + 1 ;
            $allCartItems[$productId]['price'] = $product->price * $allCartItems[$productId]['qty'];
        }else {
            $allCartItems[$productId] =  $newItemToAdd;
        }

        session()->put('cartItems', $allCartItems);

        return back()->withMessage("Item has been added to cart");

    }

    public function reduceQuantity($productId)
    {
        $product = Product::find($productId);

        $allCartItems = [];

        if (session()->has('cartItems')) {
            $allCartItems = session()->get('cartItems');
        }

        //product already in cart
        if (empty($allCartItems[$productId])) {
            return back()->withMessage('No item to remove');
        }

        $qty = $allCartItems[$productId]['qty'];

        if($qty > 1) {
            $allCartItems[$productId]['qty']--;
            $allCartItems[$productId]['price'] = $product->price * $allCartItems[$productId]['qty'];
        }

        session()->put('cartItems', $allCartItems);

        return back()->withMessage("Item has been removed from cart");

    }

    public function viewCart()
    {
        // session()->remove('cartItems');
        $allItems = session('cartItems') ?? [];

        // if(isset(session('cartItems'))) {
        //     $allItems  = session('cartItems')
        // }else {
        //     $allItems = [];
        // }

        return view('cart', compact('allItems'));
    }

    public function deleteCart($productId)
    {
        $existingCartItems = session('cartItems');

        if(isset($existingCartItems[$productId])) {

            //delete that
            unset($existingCartItems[$productId]);

            session()->put('cartItems', $existingCartItems);
        }

        return back();
    }

    // public function updateCart($productId)
    // {

    // }

}
