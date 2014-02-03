<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
[ comment:{{ $comment_id }}]

<br>
<h3>Visit Comment</h3>
{{ URL::to("projects/$project_id/issues/$issue_id/comments/$comment_id", array()) }}

<h2>New Comment</h2>
<p>{{ $body }}</p>

</body>
</html>