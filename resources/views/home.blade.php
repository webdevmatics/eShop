@extends('layouts.app')

@section('content')
<div class="container">
        <h2 class="text-center">Welcome to Eshop</h2>

        <div class="row">
            @foreach (\App\Product::all() as $item)
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" data-src="holder.js/100x180/?text=Image cap" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{$item->name}}</h4>
                            <p class="card-text">{{$item->description}}</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link">Add to cart</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

</div>
@endsection
