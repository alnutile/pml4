<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
[ issue:{{ $issue_id }}]

<br>
<h3>Visit Issue</h3>
{{ URL::to("projects/$project_id/issues/$issue_id", array()) }}

<h2>New Issue</h2>
<p>{{ $description }}</p>

</body>
</html>