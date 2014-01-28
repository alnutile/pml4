@extends('layouts.main')
@section('content')

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">Issues: {{$issue->name}}</div>
        <div class="panel-body">
                <h3>Message:</h3>
                {{ $issue->description }}
            <hr>
            <h2>Comments</h2>

            <ul class="list-group">
                @foreach ($comments as $comment)
                <li class="list-group-item">
                    {{$comment['body']}}
                    <br>
                    Reply: Link Here -> {{$comment['user_id']}}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Related Project</div>
        <div class="panel-body">
            coming soon...
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Related People</div>
        <div class="panel-body">
            coming soon...
        </div>
    </div>

</div>



@stop