@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create Product</h1>

    {!! Form::open(['route' => 'products.store','files'=>'true']) !!}

        @include('products._form-inputs')

    {!! Form::close() !!}




</div>


@endsection
