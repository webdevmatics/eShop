@extends('layouts.admin')


@section('content')
<div class="container">

    <h1>All Address</h1>

    <a class="btn btn-primary mb-3" href="{{route('address.create')}}" role="button">Create</a>

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>State</th>
                    <th>City</th>
                    <th>Full Address</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allAddress as $address)

                <tr>
                    <td scope="row"> {{$address->state}} </td>
                    <td> {{$address->city}} </td>
                    <td> {{$address->full_address}} </td>
                    <td> {{$address->mobile}} </td>

                    <td>

                        <a class="btn btn-primary btn-sm" href="{{route('address.edit', $address->id)}}">edit</a>

                        <form style="display:inline-block" action="{{ route('address.destroy', $address->id) }}"
                            method="post">
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
