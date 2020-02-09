@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Edit Product</h1>

    {!! Form::model($product, ['route' => ['products.update',$product->id], 'method' => 'put', 'files'=>'true']) !!}
            @include('products._form-inputs')
    {!! Form::close() !!}

</div>


@endsection
