
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('github_id', 'Github ID') }}
    {{ Form::text('github_id', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('project_id', 'Related Project') }}
    {{ Form::text('project_id', $project->id, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', null, array('class' => 'form-control')) }}
</div>

<div class="checkbox">
    {{ Form::label('active', 'Active') }}
    {{ Form::checkbox('active') }}
</div>

<div class="form-group">
    {{ Form::label('user_id', 'Created By') }}
    {{ Form::text('user_id', $user->id, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    [who to notify : coming soon]
</div>