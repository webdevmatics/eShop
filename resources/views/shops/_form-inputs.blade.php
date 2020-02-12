<div class="form-group">
    <label for="">Shop Name</label>
    {!! Form::text('name', null,['class'=>'form-control']) !!}
</div>



<div class="form-group">
    <label for="">Description</label>
    {!! Form::textarea('description',  null, ['class'=>'form-control']) !!}

</div>


<button type="submit" class="btn btn-primary">Submit</button>
