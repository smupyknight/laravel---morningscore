@extends('layouts.html')
@section('bodyClass', 'web')
@section('body')
    @include('components.notifications')
    @if( ! Auth::user()->requiresSetup() )
        @include('partials.portal.header')
    @endif
    <div class="content @yield('contentClass')">
        @yield('content')
    </div>
    @include('partials.portal.footer')
    @yield('pagescript')
@stop