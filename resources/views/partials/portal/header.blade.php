<header class="main-navigation">
    <nav>
        <ul class="no-stars">
            <li class="logo">
                <a href="/" class="logo-white logo"><img src="{{ asset('img/logo/logo.svg') }}" alt="morningscore logo" /></a>
                <a href="/" class="logo-blue logo"><img src="{{ asset('img/logo/logo-blue.svg') }}" alt="morningscore logo" /></a>
            </li>
			<li class="pipe">|</li>
			{{-- {!! React::component("TargetPicker", [], [
				'tag' => 'li',
				'class' => 'header-item-left'
			]) !!} --}}
			{!! React::component("DomainPicker", [], [
				'tag' => 'li',
				'class' => 'header-item-left'
			]) !!}
			{!! React::component("RangePicker", [], [
				'tag' => 'li',
			]) !!}
			<li class="pipe">|</li>
            {{--  <li>
                <p><a href="{{ route('auth.logout') }}" onclick="vl_logout()">LOG OUT</a></p>
            </li>  --}}
            <li>
                {{--  SETTING MODAL TRIGGER  --}}
                {!! React::component('modals.triggers.Anchor', [
                        'refId' => 'settings-modal',
                        'title' => 'Settings',
                        'img'   => [
                            'src' => asset('img/icons/settings.svg'),
                            'alt' => 'settings cog icon',
                        ],
                    ], 
                    [
                        'class' => 'settings-icon settings-icon-gray'
                    ]
                ) !!}
                {!! React::component('modals.triggers.Anchor', [
                        'refId' => 'settings-modal',
                        'title' => 'Settings',
                        'img'   => [
                            'src' => asset('img/icons/settings-white.svg'),
                            'alt' => 'settings cog icon',
                        ],
                    ], 
                    [
                        'class' => 'settings-icon settings-icon-white'
                    ]
                ) !!}
                
            </li>
        </ul>
    </nav>
    
    {{--  RENDERING OF SETTINGS MODAL  --}}
    {!! React::component('modals.Settings', [], [
        'ref' => 'settings-modal',
    ]) !!}
    {!! React::component('modals.ManageDomains', [], [
        'ref' => 'manage-domains-modal',
    ]) !!}
</header>
