@extends('layouts.main')


@section('content')

<h2>Create a Project</h2>

@include('_form_errors')

{{ Form::model($project, array('route' => array('projects.store'))) }}

<div class="col-md-6">
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

    {{ Form::submit('Create Project', array('class' => 'btn btn-success')) }}

{{ Form::close() }}
</div>
@stop