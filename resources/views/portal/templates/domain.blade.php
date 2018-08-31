@extends(Context::view('layouts.page'))
@section('content')
    <div style="display:flex;flex-direction:column;">
        <a href="{{ route('auth.logout') }}">Log out</a>
        <div>
            Hello {{ Auth::user()->name }}
            @if (Auth::user()->avatar !== null)
                @include('mixins.img', ['src' => Auth::user()->avatar, 'alt' => 'avatar'])
            @endif
        </div>
        
        {!! Form::open() !!}
        {!! Form::text('domain', $domain) !!}
        {!! Form::select('analytics_account', $accounts, old('analytics_account', request()->get('analytics_account')), ['onchange' => 'this.form.submit()']) !!}
        @if(isset($properties))
            {!! Form::select('analytics_property', $properties, old('analytics_property', request()->get('analytics_property')), ['onchange' => 'this.form.submit()']) !!}
        @endif
        @if(isset($views))
            {!! Form::select('analytics_view', $views, old('analytics_view', request()->get('analytics_view'))) !!}
        @endif
        {!! Form::submit('Submit') !!}
        {!! Form::close() !!}
        
@stop