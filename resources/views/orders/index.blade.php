@extends('layouts.admin')


@section('content')
<div class="container">

    <h1>All Orders</h1>


    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Status</th>
                    <th>Customer who ordered</th>
                    <th>Shipping Name</th>
                    <th>Is Paid</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)


                <tr>
                    <td scope="row"> {{$order->order_number}} </td>
                    <td> {{$order->status}} </td>
                    <td>{{$order->user->name}}</td>
                    <td> {{$order->shipping_fullname}} </td>
                    <td> {{$order->is_paid}} </td>


                    <td>

                        <a class="btn btn-primary btn-sm" href="{{route('orders.show', $order->id)}}">show</a>

                        <a class="btn btn-primary btn-sm" href="{{route('orders.edit', $order->id)}}">edit</a>

                        <form style="display:inline-block" action="{{ route('orders.destroy', $order->id) }}"
                            method="post">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
