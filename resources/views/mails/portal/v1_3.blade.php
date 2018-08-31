@extends('mails.template', [
    'subject'       => trans('mail.v1_3.subject'),
    'title'       	=> trans('mail.v1_3.title'),
    'header_img'    => "img/email/headers/v1_3.png"
])


@section('content')
	@include('mails.partials.content', [
		'paragraphs'	=> [
			trans('mail.v1_3.txt'),
		],
	])

	@include('mails.partials.content', [
		'title'	=> trans('mail.v1_3.title2'),
		'list'	=> [
			trans('mail.v1_3.l1'),
			trans('mail.v1_3.l2'),
		]
	])

	@if(App::getLocale() === 'en')
		@include('mails.partials.content', [
			'title'			=> trans('mail.v1_3.title3'),
			'paragraphs'	=> [
				trans('mail.v1_3.txt3'),
			],
		])
	@endif

	@include('mails.partials.content', [
		'title'			=> trans('mail.v1_3.title4'),
		'paragraphs'	=> [
			trans('mail.v1_3.txt4'),
		],
	])

	@include('mails.partials.button', [
		'link'	=> 'https://app.morningscore.io',
		'text'	=> trans('mail.v1_3.button'),
	])
@endsection
