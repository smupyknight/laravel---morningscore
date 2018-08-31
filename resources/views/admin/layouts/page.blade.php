@extends('layouts.html')
@section('bodyClass', 'admin')
@section('body')
    @include('partials.admin.header')
    @include('partials.admin.sidebar')
    <div class="content">
        @yield('content')
    </div>
    @include('components.notifications')
@stop