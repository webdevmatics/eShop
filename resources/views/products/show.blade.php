@extends('layouts.admin')


@section('content')
<div class="container">

    <h1> Products Details</h1>
    <div class="row">
        Name : {{$product->name}}

    </div>


    <div class="row">

        Description : {{$product->description}}</div>

    </div>

@endsection
