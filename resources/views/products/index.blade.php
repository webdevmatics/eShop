@extends('layouts.admin')


@section('content')
<div class="container">

    <h1>All Products</h1>

    <a  class="btn btn-primary mb-3" href="{{route('products.create')}}" role="button">Create</a>

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)

                    <tr>
                        <td scope="row"> {{$product->name}} </td>
                        <td> {{$product->price}} </td>
                        <td> {{$product->description}} </td>

                        <td>

                            <a class="btn btn-primary btn-sm" href="{{route('products.edit', $product->id)}}">edit</a>

                            <form style="display:inline-block" action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
