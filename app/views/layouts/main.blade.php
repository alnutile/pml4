<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/main.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script('assets/js/html5shiv.js') }}
    {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->
</head>

<body>

    @include('nav')

<div class="container">

    <div class="starter-template">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('message') }}</div>
        @endif

        @yield('content')
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

{{ HTML::script('/assets/js/jquery-1.11.0.min.js') }}
{{ HTML::script('/assets/js/bootstrap/bootstrap.min.js') }}
{{ HTML::script('/assets/js/prettify.js') }}
</body>
</html>
