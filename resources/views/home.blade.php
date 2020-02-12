@extends('layouts.app')

@section('content')
<div class="container">
        <h2 class="text-center">Welcome to Eshop</h2>

        <div class="row">
            @foreach ($allProduct as $item)
                @php

                if(!empty($item->cover_img)) {
                    $imagePath = asset('storage/'.$item->cover_img);
                }else {
                    $imagePath = asset('storage/products/default.jpg');
                }

                @endphp

                <div class="col-4">
                    <div class="card">
                    <img class="card-img-top" src="{{$imagePath}}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{$item->name}}</h4>
                            <p class="card-text">{{$item->description}}</p>
                            <p class="card-text">Category: {{$item->category->name}}</p>

                        </div>
                        <div class="card-body">
                        <a href="{{route('cart', $item->id)}}" class="card-link btn btn-primary btn-sm">Add to cart</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

</div>
@endsection
