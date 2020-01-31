@extends('layouts.app')


@section('content')

<div class="container">

<h3>Delivery Information</h3>


<form action="/order" method="post">
    @csrf

    @include('address._create-form-fields')

</form>



</div>


@endsection
