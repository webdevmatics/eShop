<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryId = request()->input('category_id');  //get category id from url

        if (!empty($categoryId)) {
            $allProducts = Product::where('category_id', $categoryId)->get();  //query to fetch products with selected category
        } else {
            $allProducts = Product::get();
        }


        return ProductResource::collection($allProducts);

        // $data = [
        //     'message'=>'Products fetch successfully',
        //     'products'=> $allProducts
        // ];

        // return response()->json($data, 200);

    }

    public function store(Request $request)
    {

        // dd($request->all());
        //add validation
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            // 'cover_img'=>'required|image'
        ]);

        //store in database
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // check if file is present
        if ($request->has('cover_img')) {
            //store file in disk
            $filePath = $request->file('cover_img')->store('products');
            //saving file in database
            $product->cover_img = $filePath;
        }

        if($request->has('category_id')) {
            $product->category_id = $request->input('category_id');

        }

        $product->save();


        return response()->json([
            'message'=>'products created',
            'data'=> $product
        ], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'products not found',
                'data' => []
            ], 404);
        }

        return new ProductResource($product);
        // return ProductResource::collection($allProducts);

        // return response()->json(['message'=>'successfulyy','data'=>$product], 200);

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
            // 'cover_img' => 'required|image'
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

        return response()->json([
            'message' => 'products saved',
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                'message' => 'products not found',
                'data' => []
            ], 404);
        }
        $product->delete();


        return response()->json([
            'message' => 'products deleted',
            'data' => $product
        ], 200);

    }
}
