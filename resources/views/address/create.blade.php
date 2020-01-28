@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create Address</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('address.store')}}" method="POST">
        @csrf
        @include('address._create-form-fields')

    </form>

</div>


@endsection
