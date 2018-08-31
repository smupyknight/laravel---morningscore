<div class="header">
    <ul class="nav left">
        @foreach(Context::breadcrumbs()->items() as $breadcrumb)
            <li class="breacrumb-item">
                @if($breadcrumb->route)
                    <a href="{{ route($breadcrumb->route) }}">{{ $breadcrumb->title }}</a>
                @else
                    {{ $breadcrumb->title }}
                @endif
            </li>
            <li class="separator slash breadcrumb-separator"></li>
        @endforeach
    </ul>
    <ul class="nav right">
        <li class="welcome-message">
            {{ transOr('admin.header.welcome', 'Welcome') }}
            <a href="#">{{ Auth::user()->name }}</a>
        </li>
        <li class="separator"></li>
        <li><a href="{{ route('auth.logout') }}">{{ transOr('admin.header.logout', 'Log out') }}</a></li>
    </ul>
</div>