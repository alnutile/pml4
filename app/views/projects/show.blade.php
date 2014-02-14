@extends('layouts.main')
@section('content')

<div ng-app="pml4">
    <div ng-controller="IssuesCtrl">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Project: {{$project->name}}</div>
            <div id="project-id" data-pid="{{$project->id}}" style="display: none;"></div>
            <div id="user-id" data-uid="{{$user->id}}" style="display: none;"></div>
            <div class="panel-body">

                <div class="well">{{ $project->description }}</div>

                <h2>Issues</h2>


                <div ng-include="issueList.url"></div>


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
        <div class="panel panel-default">
            <div class="panel-heading">Actions</div>
            <div class="panel-body">
                @if(Auth::user()->admin == 1)
                    <div class="panel-body">
                        {{ HTML::linkRoute('projects.edit', 'Edit Project', $project->id, array('class' => 'btn btn-info')) }}
                    </div>
                @endif

                <div class="panel-body">
                    {{ HTML::linkRoute('projects.issues.create', 'Create Issue', $project->id, array('class' => 'btn btn-info')) }}
                </div>
            </div>
            <div class="panel-body">
                @if(Auth::user()->admin == 1)
                <div class="panel-body">
                    <button type="button" ng-click="getGitIssues({{$project->id}}, '{{$repo_owner}}', '{{$repo_name}}')" class="btn btn-warning sync-projects" data-project-id="{{ $project->id }}" data-repo-owner="{{ $repo_owner }}" data-repo-nam="{{ $repo_name }}">Sync with Github Issues</button>

                    <div ng-include="template.url"></div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</div>

{{ HTML::script('assets/js/angular/angular.min.js') }}
{{ HTML::script('assets/js/sync_projects_issues.js') }}

@stop