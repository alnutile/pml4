@extends('layouts.main')
@section('content')

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">Project: {{$project->name}}</div>
        <div class="panel-body">
            <h2>Issues</h2>

            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Description</th>
                </tr>
                </thead>
                @foreach ($issues as $issue)
                <tbody>
                @if ($issue['active'])
                <tr class="active">
                    @else
                <tr>
                    @endif
                    <td>{{ $issue['id'] }}</td>
                    <td>{{ HTML::linkRoute('issues.show', $issue['name'], $issue['id']) }}</td>
                    <td>{{ $issue['active'] }}</td>
                    <td>{{ $issue['description'] }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Related People</div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach ($users as $user)
                <li class="list-group-item">{{ HTML::linkRoute('users.show', $user['username'], $user['id']) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@stop