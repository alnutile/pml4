@if (Session::has('emailsSent'))
    <div class="alert alert-success">{{ Session::get('emailsSent') }}</div>
@endif

@if (Session::has('emailsWho'))
    <div class="alert alert-info">{{ Session::get('emailsWho') }}</div>
@endif

@if (Session::has('emailsFailed'))
    <div class="alert alert-danger">{{ Session::get('emailsFailed') }}</div>
@endif

@if ( Session::has('emailsWhoFailed'))
    <div class="alert alert-danger">{{ Session::get('emailsWhoFailed') }}</div>
@endif