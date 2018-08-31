@extends(Context::view('layouts.page'))
@section('title', transOr('auth.pages.forgot-password.title', 'Reset'))
@section('description', transOr('auth.pages.forgot-password.description', ''))
@section('content')
    {!! Form::open(['route' => 'auth.forgot-password.do']) !!}
    <div class="content">
    <div class="fields">
        <input type="email" name="email" value="{{ old('email') }}"
               placeholder="{{ transOr('auth.fields.email.placeholder', 'Email') }}" required/>
    </div>

    <div class="actions">
        <br>
        <div class="actions-right">
            <button class="button" type="submit">{{ transOr('auth.actions.send', 'Reset password') }}</button>
            <div><h6><a href="{{ route('auth.login') }}">{{ transOr('auth.actions.back-to-login', 'Back to login') }}</a></h6></div>    
        </div>
        
    </div>

    <div class="pattern-outer">
        <div class="pattern">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 35 35" enable-background="new 0 0 50 50" xml:space="preserve" preserveAspectRatio="none slice"></svg>
        </div>
    </div>
</div>
    {!! Form::close() !!}
@stop