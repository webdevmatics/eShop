@extends('layouts.front')


@section('content')
{{-- <h2 class="text-center">Welcome to Eshop {{ now()->format('Y-m-d') }}</h2> --}}

<!-- product area start -->
@include('partials._product')

@endsection
