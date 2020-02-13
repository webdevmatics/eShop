@extends('layouts.admin')

@section('content')

    <h1>Dashboard</h1>

    @can('seller')
        <a href="{{ route('shops.show', $shop->id) }}">{{ $shop->name}}</a>

    @else
        <a href="{{route('shops.create')}}">Create Shop</a>

    @endcan

@endsection
