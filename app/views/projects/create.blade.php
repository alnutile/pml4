@extends('layouts.main')


@section('content')


<h2>Create a Project</h2>

@include('_form_errors')

<div class="col-md-6">
    {{ Form::model($model, array('route' => array('projects.store'))) }}
    @include('projects._form')
    {{ Form::submit('Create Project', array('class' => 'btn btn-success')) }}

    {{ Form::close() }}
</div>
@stop