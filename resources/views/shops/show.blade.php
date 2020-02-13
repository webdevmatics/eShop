@extends('layouts.admin')

@section('content')

<h1>Welcome to {{$shop->name}}</h1>

<p>{{ $shop->description }}</p>

<a class="btn btn-primary" href="{{ route('products.create') }}">Add product to shop</a>



<h3>My products</h3>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shop->products as $product)
            <tr>
                <td scope="row">{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
            </tr>
        @endforeach


    </tbody>
</table>

@endsection


