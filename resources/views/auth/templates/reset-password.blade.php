@extends(Context::view('layouts.page'))
@section('title', transOr('auth.pages.reset-password.title', 'Login'))
@section('description', transOr('auth.pages.reset-password.description', ''))
@section('content')
    {!! Form::open(['route' => 'auth.reset-password.do']) !!}

    <input type="hidden" name="token" value="{{ $token }}"/>

    <div class="fields">
        <input type="email" name="email" value="{{ old('email') }}"
               placeholder="{{ transOr('auth.fields.email.placeholder', 'Email') }}" required/>
        <input type="password" name="password"
               placeholder="{{ transOr('auth.fields.password.placeholder', 'Password') }}" required/>
        <input type="password" name="password_confirmation"
               placeholder="{{ transOr('auth.fields.password_confirmation.placeholder', 'Password confirmation') }}"
               required/>
    </div>

    <div class="actions">
        <div class="actions-left">
            <a href="{{ route('auth.login') }}">{{ transOr('auth.actions.back-to-login', 'Back to login') }}</a>
        </div>
        <div class="actions-right">
            <button class="btn primary" type="submit">{{ transOr('auth.actions.reset', 'Reset') }}</button>
        </div>
    </div>

    <div class="pattern-outer">
        <div class="pattern">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 35 35" enable-background="new 0 0 50 50" xml:space="preserve" preserveAspectRatio="none slice"></svg>
        </div>
    </div>

    {!! Form::close() !!}
@stop