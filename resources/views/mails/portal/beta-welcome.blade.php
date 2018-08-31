@extends('mails.template', [
    'subject'       => trans('mail.beta_welcome.subject'),
    'title'         => trans('mail.beta_welcome.title'),
    'sub_title'     => trans('mail.beta_welcome.sub_title'),
    'header_img'    => "img/email/header-mail.jpg"
])

@section('content')
	@include('mails.partials.content', [
		'paragraphs'	=> [
			trans('mail.beta_welcome.body'),
			trans('mail.beta_welcome.email') . ': <b>' . $email . '</b>',
			trans('mail.beta_welcome.pass') . ': <b>' . $pass . '</b>',
		]
	])

	@include('mails.partials.button', [
		'link'	=> 'https://app.morningscore.io/login',
		'text'	=> trans('mail.beta_welcome.link'),
	])
@endsection
