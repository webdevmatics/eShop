@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create Product</h1>

    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="">Product Title</label>
            <input type="text" name="name" id="" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Price</label>
            <input type="text" name="price" id="" class="form-control">
        </div>

        <div class="form-group">
          <label for="">Description</label>
          <textarea class="form-control" name="description" id="" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label for="">Product cover image</label>
          <input type="file" class="form-control-file" name="cover_img" id="" placeholder="" aria-describedby="fileHelpId">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

</div>


@endsection
