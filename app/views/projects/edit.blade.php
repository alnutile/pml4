@extends('layouts.main')


@section('content')


<h2>Edit a Project</h2>

@include('_form_errors')

<div class="col-md-6">
    {{ Form::model($model, array('route' => array('projects.update'))) }}
    @include('projects._form')
    {{ Form::submit('Update Project', array('class' => 'btn btn-success')) }}

    {{ Form::close() }}
</div>
@stop