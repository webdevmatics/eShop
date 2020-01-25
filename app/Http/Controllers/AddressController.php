<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allAddress = auth()->user()->address;
        // $allAddress = Address::where('user_id', auth()->id())->get();

        return view('address.index', ['allAddress'=> $allAddress]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation

        $request->validate([
            'state' => 'required',
            'mobile' => 'required',
            'city' => 'required',
            'full_address' => 'required'
        ]);

        //save to db (first way)
        // $address = new Address();
        // $address->state = $request->input('state');
        // $address->mobile = $request->input('mobile');
        // $address->city = $request->input('city');
        // $address->full_address = $request->input('full_address');
        // $address->user_id = auth()->user()->id;
        // $address->save();

        // second way
        auth()->user()->address()->create($request->all());

        //redirection
        return redirect()->route('address.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'state' => 'required',
            'mobile' => 'required',
            'city' => 'required',
            'full_address' => 'required'
        ]);

        $address->update($request->all());

        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('address.index');
    }
}
