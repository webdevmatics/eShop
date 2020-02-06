@extends('layouts.admin')


@section('content')
<div class="container">

    <h1> Order Details</h1>


    <h2>Order Number : {{ $order->order_number }}</h2>

    <h3>Ordered Items</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($order->items as $item)
                <tr>
                    <td scope="row">{{ $item->name }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                </tr>
            @endforeach



        </tbody>
    </table>


    <hr>
    <h3>
        Total: {{$order->grand_total}}
    </h3>

    <p>
        {{$order->notes}}
    </p>


</div>

@endsection
