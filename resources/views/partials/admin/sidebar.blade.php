<div class="sidebar">
    <div class="brand">
        <a href="{{ route('admin') }}">
            <img src="{{ asset('img/logo/logo.svg') }}" alt="Logo"/>
            Morningscore
        </a>
    </div>
    <div class="nav-container">
        {!! React::component('menus.SidebarMenu', ['items' => Context::menu('sidebar')->items()]) !!}
    </div>
</div>