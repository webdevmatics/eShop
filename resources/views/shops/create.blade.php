@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create Shop</h1>

    {!! Form::open(['route' => 'shops.store']) !!}

        @include('shops._form-inputs')

    {!! Form::close() !!}




</div>


@endsection
