@extends('layouts.main')

@section('content')

<div class="container login">
    <div class="row">
        <div class="center col-md-4 well">
            <legend>Please Sign In</legend>
            @include('sessions.notice')
            <form method="POST" action="{{{ Confide::checkAction('UserController@do_login') ?: URL::to('/user/login') }}}" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <fieldset>
                    <div class="form-group">
                        <label for="email">{{{ Lang::get('confide::confide.username_e_mail') }}}</label>
                        <input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                    </div>
                    <div class="form-group">
                        <label for="password">
                            {{{ Lang::get('confide::confide.password') }}}
                            <small>
                                <a href="{{{ (Confide::checkAction('UserController@forgot_password')) ?: 'forgot' }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
                            </small>
                        </label>
                        <input class="form-control" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                    </div>

                    <div class="form-group">
                        <button tabindex="3" type="submit" class="btn btn-success">{{{ Lang::get('confide::confide.login.submit') }}}</button>
                    </div>
                    <div class="form-group">
                            <label for="remember" class="checkbox">{{{ Lang::get('confide::confide.login.remember') }}}
                                <input type="hidden" name="remember" value="0">
                                <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
                            </label>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@stop