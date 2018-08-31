@extends(Context::view('layouts.page'))
@section('title', transOr('auth.pages.login.title', 'Log in'))
@section('subtitle', transOr('auth.pages.login.subtitle', ''))
@section('link', 'register')
@section('linktext', transOr('auth.pages.login.linktext', 'Register'))
@section('linktext2', transOr('auth.pages.login.linktext2', ''))
@section('link_title', transOr('auth.pages.login.link_title', ''))
@section('content')

    <div class="form-content">
        
        {!! Form::open(['route' => 'auth.login.do']) !!}
        
        <form>
            <div class="field-container">
                <label>@lang('auth.forms.email')</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="@lang('auth.forms.email_ph')" required autofocus>
                <label>@lang('auth.forms.pass')</label>
                <input type="password" name="password" placeholder="@lang('auth.forms.pass_ph')" required>
            </div>
            <div class="submit-container">
                <a href="{{ route('auth.forgot-password') }}" title="@lang('auth.pages.login.forgot_title')">@lang('auth.pages.login.forgot')</a>
                <input type="submit" name="" value="@lang('auth.forms.login')" class="button">
            </div>
        </form>
        
        {!! Form::close() !!}
        
    </div>
    <div class="form-or-line">@lang('auth.or')</div>
    <div class="form-login">
        <a href="{{ route('portal.social', 'google') }}">
            <div class="google-login button">@lang('auth.forms.social_login') Google</div>
        </a>
    </div>
    <br>
    <div class="form-login">
        <a href="{{ route('portal.social', 'facebook') }}">
            <div class="facebook-login button">@lang('auth.forms.social_login') Facebook</div>
        </a>
    </div>

    <div class="pattern-outer">
        <div class="pattern">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 35 35" enable-background="new 0 0 50 50" xml:space="preserve" preserveAspectRatio="none slice"></svg>
        </div>
    </div>

@stop
@section('pagescript')
    @include('partials.viral_loops')
@stop
