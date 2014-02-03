@extends('layouts.main')

@section('content')

@include('_form_errors')
<div class="row">
    <h2>Edit an Comment #{{ $model->id }} for Issue -> {{ $issue_name}}</h2>
    <div class="col-md-6">

        {{ Form::model($model, array('route' => array('projects.issues.comments.update', $project, $issue->id, $model->id), 'method' => 'PUT')) }}

        @include('comments._form')

        {{ Form::submit('Update Comment', array('class' => 'btn btn-success')) }}
        {{ Form::close() }}
    </div>

    </br>

    <div class="col-md-4 well">
        <h3>Related Issue:</h3>
        {{ $issue->description }}
    </div>
</div>
@stop