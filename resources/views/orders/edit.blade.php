@extends('layouts.admin')


@section('content')

    <div class="container">
        <h1>Edit Order</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('orders.update', $order->id)}}" method="POST">
            @csrf
            @method('put')

            {{-- <div class="form-group">
                <label for="">Order Status</label>
                <input type="text" name="status" id="" class="form-control" value="{{ $order->status }}">
            </div> --}}

            {{-- <div class="form-group">
              <label for="">Order Status</label>
              <select class="form-control" name="status" id="">
                <option {{$order->status == 'processing' ? 'selected': null }} value="processing">Processing</option>
                <option {{$order->status == 'pending' ? 'selected': null }}  value="pending">PENDING</option>
                <option {{$order->status == 'completed' ? 'selected': null }}  value="completed">Completed</option>
                <option {{$order->status == 'decline' ? 'selected': null }} value="decline">Decline</option>
              </select>
            </div> --}}

            <div class="form-group">
                <label for="">Order Status</label>
                <select class="form-control" name="status" id="">

                    @foreach ($statusOptions as $val)
                        <option {{$order->status == $val ? 'selected': null }} value="{{$val}}">{{ $val}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                        <label for="">Paid</label>
                        <select class="form-control" name="is_paid" id="">
                            @foreach ([0,1] as $val)
                                <option {{$order->is_paid == $val ? 'selected': null }} value="{{$val}}">{{ $val==1 ?"Paid":"Not Paid" }}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                <label for="">Notes</label>
                <input type="text" name="notes" id="" class="form-control" value="{{ $order->notes }}">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>

@endsection
