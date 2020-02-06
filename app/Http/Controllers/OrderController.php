<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Mail\OrderCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Gate::denies('isAdmin')) {
            dd('you are not admin');
        }
        // $orders = Order::get();


        $orders = Order::with(['user'])->get();
        // $orders = Order::get()->load('user');
        // $orders = Order::get()->load('user');
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'shipping_fullname' => 'required',
            'shipping_state' => 'required',
            'shipping_city' => 'required',
            'shipping_address' => 'required',
            'shipping_phone' => 'required',
            'shipping_zipcode' => 'required'
        ]);

       //save to db
        $order = new Order();

        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_state = $request->input('shipping_state');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_phone = $request->input('shipping_phone');
        $order->shipping_zipcode = $request->input('shipping_zipcode');


        $order->billing_fullname = $request->input('shipping_fullname');
        $order->billing_state = $request->input('shipping_state');
        $order->billing_city = $request->input('shipping_city');
        $order->billing_address = $request->input('shipping_address');
        $order->billing_phone = $request->input('shipping_phone');
        $order->billing_zipcode = $request->input('shipping_zipcode');



        $order->payment_method = 'home_delivery';
        $order->order_number = uniqid('OrderNumber-');
        $order->status = 'pending';
        $order->is_paid = 0;

        $order->grand_total = \App\Cart::totalPrice();
        $order->item_count = \App\Cart::totalItems();

        $order->user_id = auth()->user()->id;
        $order->save();


        //save order items (products)

        foreach(session('cartItems') as $productId => $cartItem) {
            $orderItem = new OrderItem();

            $orderItem->product_id = $productId;
            $orderItem->order_id = $order->id;
            $orderItem->quantity = $cartItem['qty'];
            $orderItem->price = $cartItem['price'];

            $orderItem->save();
        }

        //empty the cart
        session()->remove('cartItems');


        //send mail to customer

        Mail::to(auth()->user()->email)->send(new OrderCompleted);


        // return redirect()->route('order.completed');
        return redirect('/order-completed');
    }

    public function thankyou()
    {
        return view('order-completed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

        // dd($order->items);
        // OrderItem::where('order_id', $order->id)->get();
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $statusOptions = ['processing', 'pending', 'completed', 'decline'];

        return view('orders.edit',compact('order','statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        $order->status = $request->input('status');
        $order->is_paid = $request->input('is_paid');
        $order->notes = $request->input('notes');
        $order->save();


        return redirect()->route('orders.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
