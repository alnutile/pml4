
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('accountingurl', 'Accounting Url') }}
    {{ Form::text('accountingurl', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('giturl', 'Git Url') }}
    {{ Form::text('giturl', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', null, array('class' => 'form-control')) }}
</div>

<div class="checkbox">
    {{ Form::label('active', 'Active') }}
    {{ Form::checkbox('active') }}
</div>

<div class="form-group">
    {{ Form::select('people[]', $options_all, $options_selected, array('multiple' => true, 'id' => 'people')) }}
</div>