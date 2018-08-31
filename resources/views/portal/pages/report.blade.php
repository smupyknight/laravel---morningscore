@extends('portal.layouts.page')
@section('contentClass', 'report')
@section('content')
    
    {!! React::component('MobileOverlay', [], []) !!}

    @component('components.portal.cover')
        @slot('title')
			@lang('report.misc.cover.title') {{ Auth::user()->first_name }}
        @endslot
        @slot('tagline')
			@lang('report.misc.cover.tagline')
        @endslot
    @endcomponent
    
    <div class="report-wrapper">
        <div class="report-container">
            <div class="morningscore-stats">
                
                {{--  Your morningscore component  --}}
                {!! React::component('CurrentMorningscore') !!}

                {{--  Morningscore graph component  --}}
                {!! React::component('HistoricalMorningscore', [], [
                    "class" => "historical-morningscore-wrapper"
                ]) !!}

                {{--  Competitors box  --}}
                {!! React::component('Competitors') !!}
            </div>

            {{--  SEO Traffic box  --}}
			{{-- {!! React::component("SeoTraffic") !!} --}}

            {{--  SEO Potential box  --}}
            {!! React::component('SEOPotential') !!}

            {{--  REPORTS  --}}
            <div class="reports-section">
                {!! React::component("ReportTabs") !!}
            </div>

            {{--  COMING SOONS  --}}
            
            {!! React::component("ComingActivities") !!}
            {!! React::component("ComingInvestments") !!}
            
            
        </div>

        {{--  
            -----------------------------------------------
            MODALS
            -----------------------------------------------    
        --}}
		{!! React::component('modals.SeoTrafficPotentialMathModal', [], [
            'ref' => 'seo-traffic-potential-math-modal',
        ]) !!}
        {!! React::component('modals.AddKeyword', [
            'modalContainerClass' => 'tight'
        ], [
            'ref' => 'add-keyword-modal',
        ]) !!}
        {!! React::component('modals.RemoveKeyword', [
            'modalContainerClass' => 'tight'
        ], [
            'ref' => 'remove-keyword-modal',
        ]) !!}
        {!! React::component('modals.MorningscoreMathModal', [
            'modalContainerClass' => 'tight'
        ], [
            'ref' => 'morningscore-math-modal',
        ]) !!}
        {!! React::component('modals.InformationModal', [], [
            'ref' => 'information-modal',
        ]) !!}
        {!! React::component('modals.SEOPotentialModal', [], [
            'ref' => 'seo-potential-modal',
        ]) !!}
        {!! React::component('modals.CompetitorLinksModal', [], [
            'ref' => 'competitor-links-modal',
        ]) !!}
        {!! React::component('modals.NewLinksModal', [], [
            'ref' => 'new-links-modal',
        ]) !!}
        {!! React::component('modals.LostLinksModal', [], [
            'ref' => 'lost-links-modal',
        ]) !!}
        {!! React::component('modals.AllLinksModal', [], [
            'ref' => 'all-links-modal',
        ]) !!}
        {!! React::component('modals.WebsiteLinksModal', [], [
            'ref' => 'website-links-modal',
        ]) !!}
        {!! React::component('modals.LinkStrengthModal', [], [
            'ref' => 'link-strength-modal',
        ]) !!}
        {!! React::component('modals.TrackedKeywordsModal', [], [
            'ref' => 'tracked-keywords-modal',
        ]) !!}
        {!! React::component('modals.SuggestedKeywordsModal', [], [
            'ref' => 'suggested-keywords-modal',
        ]) !!}
		{!! React::component('modals.CompetitorsMathModal', [], [
            'ref' => 'competitors-math-modal',
        ]) !!}

		@if(Session::get('first_visit'))
			{!! React::component('modals.WelcomeModal', [
				'modalContainerClass' => 'tight'
			], [
				{{--  'ref' => 'welcome-modal',  --}}
			]) !!}
			{!! Session::forget('first_visit') !!}
		@endif



            {{--  Activity  --}}
            {{--  <div class="activity-container">
                @component('components.portal.report.recent-activity')
                @endcomponent
                @component('components.portal.report.competitor-activity')
                @endcomponent
            </div>  --}}

            
            
        </div>
    </div>

@stop
