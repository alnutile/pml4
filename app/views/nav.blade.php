<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <!--logged in or not-->
                @if(Auth::guest())
                    <li>{{ link_to_action('UserController@login', 'Sign In') }}</li>
                    <li>{{ link_to_action('UserController@signup', 'Sign Up') }}</li>
                @else
                    <li>{{ link_to_action('DashboardController@index', 'Dashboard') }}</li>
                    <li>{{ link_to_action('UserController@logout', 'Sign Out') }}</li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>