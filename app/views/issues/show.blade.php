@extends('layouts.main')
@section('content')

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">Issue: {{$issue->name}}</div>
        <div class="panel-body">

            <div class="well">{{ $issue->description }}</div>

            <h2>Comments</h2>

            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Details</th>
                    <th>Date</th>
                </tr>
                </thead>
                @foreach ($comments as $comment)
                <tbody>
                    <tr>
                        <td>
                            <h4><span class="label label-default">{{ HTML::linkRoute('projects.issues.comments.edit', "Comment: #" . $comment['id'], array($project->id, $issue->id, $comment['id']), array('class' => 'white')) }}</span></h4>
                            {{ $comment['body'] }}
                        </td>
                        <td>
                            <?php echo date('M d h:m', strtotime($comment['created_at'])); ?>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Actions</div>
        <div class="panel-body">
            @if(Auth::user()->admin == 1)
            <div class="panel-body">
                {{ HTML::linkRoute('projects.edit', 'Edit Project', $project->id, array('class' => 'btn btn-success')) }}
            </div>
            @endif

            <div class="panel-body">
                {{ HTML::linkRoute('projects.issues.edit', 'Edit Issue', array($project->id, $issue->id), array('class' => 'btn btn-info')) }}
            </div>

            <div class="panel-body">
                {{ HTML::linkRoute('projects.issues.comments.create', 'New Comment', array($project->id, $issue->id), array('class' => 'btn btn-warning')) }}
            </div>
        </div>
    </div>


</div>

@stop



@stop