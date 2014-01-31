@extends('layouts.main')


@section('content')


<h2>Create an Issue for Project -> {{ $project->name}}</h2>

@include('_form_errors')

<div class="col-md-6">
    {{ Form::model($model, array('route' => array('projects.issues.store'))) }}
    @include('issues._form')
    {{ Form::submit('Create Issue', array('class' => 'btn btn-success')) }}

    {{ Form::close() }}
</div>
@stop