@extends('layouts.app')


@section('content')

<h3>Your cart</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        @forelse ($allItems as $productId => $item)
            <tr>
                <td scope="row">{{ $item['name'] }}</td>
                <td>{{ $item['price'] }}</td>
                <td>
                    <a class="btn btn-danger btn-sm" href="{{ route('cart.reduce', $productId) }}">
                        <i class="fas fa-minus"></i>
                    </a>

                        {{ $item['qty'] }}
                    <a class="btn btn-success btn-sm" href="{{ route('cart', $productId) }}">
                        <i class="fas fa-plus"></i>
                    </a>
                </td>

                <td>
                    <a href="{{ route('cart.delete', $productId) }}">delete</a>
                </td>
            </tr>

        @empty
                <tr>
                    <td>No items in cart</td>
                </tr>

        @endforelse

        </tbody>
    </table>

@endsection
