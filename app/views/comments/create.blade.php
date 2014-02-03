@extends('layouts.main')


@section('content')


<h2>Create an Comment for Issue -> {{ $issue_name }}</h2>

@include('_form_errors')

<div class="col-md-6">
    {{ Form::model($model, array('route' => array('projects.issues.comments.store', $project, $issue))) }}

        @include('comments._form')

    {{ Form::submit('Create Comment', array('class' => 'btn btn-success')) }}
    {{ Form::close() }}
</div>
@stop