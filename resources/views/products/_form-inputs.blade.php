<div class="form-group">
    <label for="">Product Title</label>
    {!! Form::text('name', null,['class'=>'form-control']) !!}
</div>



<div class="form-group">
    <label for="">Category</label>
    {!! Form::select('category_id', $allCategories, null, ['class'=>'form-control']) !!}

</div>



<div class="form-group">
    <label for="">Price</label>
    {!! Form::number('price', null,['class'=>'form-control']) !!}
</div>


<div class="form-group">
    <label for="">Description</label>
    {!! Form::textarea('description', null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="">Product cover image</label>
    {!! Form::file('cover_img') !!}
</div>

<button type="submit" class="btn btn-primary">Submit</button>
