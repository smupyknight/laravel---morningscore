@extends('layouts.html')
@section('bodyClass', 'auth')
@section('body')
    @include('components.notifications')

    <div class="login-wrapper">
        <div class="form-container @yield('class')">
        	<div class="form-logo">
        		<a href="{{ 'https://morningscore.io?lang=' . App::getLocale() }}" class="logo-blue logo"><img src="{{ asset('img/logo/logo-blue.svg') }}" alt="morningscore logo" /></a>
        	</div>
            <div class="form-text">
                <h1>@yield('title')</h1>
                <p>
                    <span>@yield('subtitle')</span>
                    <span><a href="@yield('link')" title="@yield('link_title')">@yield('linktext')</a> @yield('linktext2')</span>
                </p>
            </div>
            @yield('content')

            <div class="form-copyright">
                &copy;{{ date("Y") }} @lang('auth.copyright') <a href="https://morningscore.io/privacy-policy/" target="_blank" title="@lang('auth.privacy_policy')">@lang('auth.privacy_policy')</a>
            </div>
        </div>
        <div class="form-background">
			<div class="form-wrapper-bg"></div>
			<div class="background-slide-wrapper">
				<div class="svg-container">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 1080" preserveAspectRatio="none">
						<defs>
							<style>.cls-1,.cls-2,.cls-3{fill:#fff;}.cls-1{opacity:0.6;}.cls-2{opacity:0.4;}
							</style>
						</defs>

						<path class="cls-1" d="M0,0H166.13S12.61,256.82,137.72,540c128,289.68,67,443.23,11.16,540H0V0Z"></path>
						<path class="cls-2" d="M0,0H142.8S-42.13,268.26,120.07,599.45C226.38,816.52,147.53,1024.83,99,1080H0V0Z"></path>
						<path class="cls-3" d="M0,0H86S-32.3,298.64,63.23,540s50.42,469.8,10.61,540H0V0Z"></path>
					</svg>
				</div>
				<div class="background-slides">
					<div class="slide object-fit">
						@if(file_exists(public_path('img/bg-image.jpg')))
                            @include('mixins.img', ['src' => asset('img/bg-image.jpg'), 'alt' => ''])
                        @endif
					</div>
				</div>
				<div class="background-overlay"></div>
				{{-- <div class="background-text-wrapper">
					<div class="background-text-container">
						<div class="play-button">
                            @if(file_exists(public_path('img/icons/play-arrow.svg')))
                                @include('mixins.img', ['src' => asset('img/icons/play-arrow.svg'), 'alt' => ''])
                            @endif
						</div>
						<h2>Plan your trip</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing</p>
						<div class="slide-nav-container">
							<span class="slide-nav active"></span>
							<span class="slide-nav"></span>
							<span class="slide-nav"></span>
						</div>
					</div>
				</div> --}}
			</div>
		</div>
    </div>
    @yield('pagescript')

@stop
