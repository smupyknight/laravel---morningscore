@extends(Context::view('layouts.page'))
@section('class', 'register')
@section('title', transOr('auth.pages.register.title', 'Log in'))
@section('subtitle', transOr('auth.pages.register.subtitle', ''))
@section('link', 'login')
@section('linktext', transOr('auth.pages.register.linktext', 'Register'))
@section('linktext2', transOr('auth.pages.register.linktext2', ''))
@section('link_title', transOr('auth.pages.register.link_title', ''))
@section('content')
    
    <div class="form-content">
        
        {!! Form::open(['route' => 'auth.register.do']) !!}
        
        <form>
            <div class="field-container">
                <label>@lang('auth.forms.email')</label>
                <input type="email" name="email" placeholder="@lang('auth.forms.email_ph')" required>
                <label>@lang('auth.forms.pass')</label>
                <input type="password" name="password" placeholder="@lang('auth.forms.pass_ph')" required>
                <label>@lang('auth.forms.conf_pass')</label>
                <input type="password" name="password_confirmation" placeholder="@lang('auth.forms.conf_pass_ph')" required>
            </div>
            <div class="submit-container register">
                <input type="submit" name="" value="@lang('auth.forms.create')" class="button">
            </div>
        </form>

        {!! Form::close() !!}
        
    </div>
	<!--
    <div class="form-tos-line">
		@lang('auth.pages.register.terms') <a href="https://morningscore.io/privacy-policy/" target="_blank" title="">@lang('auth.pages.register.terms_link')</a>
    </div>
	-->

    
    <div class="form-or-line">@lang('auth.or')</div>
    <div class="form-login">
        <a href="{{ route('portal.social', 'google') }}">
            <div class="google-login button">@lang('auth.forms.social_reg') Google</div>
        </a>
    </div>
    <br>
    <div class="form-login">
        <a href="{{ route('portal.social', 'facebook') }}">
            <div class="facebook-login button">@lang('auth.forms.social_reg') Facebook</div>
        </a>
        <br>
    </div>




@stop
@section('pagescript')
    @include('partials.viral_loops')
@stop
