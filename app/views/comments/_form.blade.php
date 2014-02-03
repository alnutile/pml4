
<div class="form-group">
    {{ Form::label('body', 'Description') }}
    {{ Form::textarea('body', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('github_id', "Github ID") }}
    {{ Form::text('github_id', $github_id, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('user_id', "User: $user->email") }}
    {{ Form::hidden('user_id', $user->id, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('issue_id', "Related Issue: $issue_name") }}
    {{ Form::hidden('issue_id', $issue, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    [who to notify : coming soon]
</div>