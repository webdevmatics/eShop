@extends('layouts.app')


@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">{{\App\Cart::totalItems()}}</span>
            </h4>
            <ul class="list-group mb-3">

                @foreach ($cartItems as $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$item['name']}}</h6>
                    </div>
                    <span class="text-muted">{{$item['price']}}</span>
                </li>
                @endforeach

                Total Price: {{App\Cart::totalPrice()}}

            </ul>

        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>

            @if(!$address->isEmpty())
            <div class="row">
                <ul>
                    @foreach ($address as $item)
                    <li>
                        {{$item->full_address}},

                        {{$item->state}}, {{$item->city}}


                        <a class="btn btn-primary btn-sm" href="#" role="button">Edit</a>
                    </li>
                    @endforeach

                </ul>
            </div>

            @else

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#billing-address-form">Add
                new</button>

                <!-- Modal -->
                <div class="modal fade" id="billing-address-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create new</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('address.store', ['checkout'=>'1'])}}" method="POST">
                                @csrf
                                @include('address._create-form-fields')

                            </form>

                            </div>

                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>

</div>


@endsection
