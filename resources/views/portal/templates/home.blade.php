@extends(Context::view('layouts.page'))
@section('content')
    <div style="display:flex;flex-direction:column;">
        <a href="{{ route('auth.logout') }}" onclick="vl_logout()">Log out</a>
        <div>
            Hello {{ Auth::user()->name }}
            @if (Auth::user()->avatar !== null)
                @include('mixins.img', ['src' => Auth::user()->avatar, 'alt' => 'avatar'])
            @endif
        </div>
        <div class="form-google-login">
            <a href="{{ route('portal.social', 'google') }}">
                <div class="google-login button">Link Google account</div>
            </a>
        </div>
        <div class="form-google-login">
            <a href="{{ route('portal.social', 'facebook') }}">
                <div class="google-login button">Link Facebook account</div>
            </a>
        </div>

        </br>
        </br>
        </br>

        <h4>Companies</h4>
        <ul style="list-style-type:disc">
            @foreach (Auth::user()->companies as $comp)
                <li>{{ $comp->name }}</li>
                <ul style="list-style-type:disc">
                @foreach ($comp->domains as $domain)
                    <li>
                        {{ $domain->domain }}
                        @if (! $domain->hasGoogleAnalyticsView())
                                <a href="{{ route('portal.google.connect', $domain->id) }}">
                                    <div class="google-login button">Link Google Analytics</div>
                                </a>
                        @endif
                    </li>
                @endforeach
                </ul>
            @endforeach
        </ul>
    </div>
    <div data-vl-widget="embedForm"></div>
    <div data-vl-widget="milestoneWidget"></div>
@stop
@section('pagescript')
    @include('partials.viral_loops')
    <script type="text/javascript">
        var fname = "{{ Auth::user()->first_name }}";
        var lname = "{{ Auth::user()->last_name }}";
        var email = "{{ Auth::user()->email }}";
    </script>
    <script src="{{ asset('external/viral-loops/signup.js') }}"></script>
    <script src="{{ asset('external/viral-loops/logout.js') }}"></script>
@stop