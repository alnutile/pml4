@extends('layouts.main')
@section('content')
<h1>Dashboard</h1>
<hr>

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
            <h2>Projects</h2>

            <ul class="list-group">
                @foreach ($projects as $project)
                <li class="list-group-item">
                    {{ HTML::linkRoute('projects.show', $project['name'], $project['id']) }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Related Actions</div>
        <div class="panel-body">
            {{ HTML::linkRoute('projects.create', 'Create Project', array(), array('class' => 'btn btn-info')) }}
        </div>
    </div>
</div>

@stop