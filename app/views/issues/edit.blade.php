@extends('layouts.main')


@section('content')

<h2>Update Issue {{ $model->name }} for Project -> {{ $project->name}}</h2>

@include('_form_errors')

<div class="col-md-6">
    {{ Form::model($model, array('route' => array('projects.issues.update' , $project->id, $model->id), 'method' => 'PUT')) }}

        @include('issues._form')

        {{ Form::submit('Update Issue', array('class' => 'btn btn-success')) }}
    {{ Form::close() }}
</div>
@stop