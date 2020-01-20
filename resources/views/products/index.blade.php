@extends('layouts.app')


@section('content')
<div class="container">


    <h1>All Products</h1>

    <div class="row">

        @foreach($products as $product)

        <div class="col">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{$product->name}}</h4>
                    <small>{{$product->price}}</small>
                    <p class="card-text">{{$product->description}}</p>

                    @if(auth()->check())
                        <a href="{{route('products.edit', $product->id)}}">edit</a>

                        <form style="display:inline-block" action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf 
                            @method('delete')   

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection