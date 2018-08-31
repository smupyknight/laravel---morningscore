@extends('mails.template', [
    'subject'       => trans('mail.welcome.subject'),
    'title'       	=> trans('mail.welcome.title'),
    'header_img'    => "img/email/header-mail.jpg"
])


@section('content')
	@include('mails.partials.content', [
		'paragraphs'	=> [
			trans('mail.welcome.txt_1'),
			trans('mail.welcome.txt_2')
		],
		'subtitle' => trans('mail.welcome.sign_off')
	])

	@include('mails.partials.button', [
		'link'	=> 'https://www.facebook.com/morningscore/',
		'text'	=> trans('mail.welcome.button'),
	])
@endsection
