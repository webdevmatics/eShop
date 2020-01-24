@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Edit Address</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('address.update', $address->id)}}" method="POST">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="">State</label>
            <input type="text" name="state" id="" class="form-control" value="{{ $address->state }}">
        </div>

        <div class="form-group">
            <label for="">City</label>
            <input type="text" name="city" id="" class="form-control" value="{{ $address->city }}">
        </div>

        <div class="form-group">
            <label for="">Full Address</label>
            <input type="text" name="full_address" id="" class="form-control" value="{{ $address->full_address }}">
        </div>

        <div class="form-group">
            <label for="">Mobile</label>
            <input type="text" name="mobile" id="" class="form-control" value="{{ $address->mobile }}">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

</div>


@endsection
