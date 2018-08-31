@extends('mails.template', [
    'subject'       => trans('mail.v1_1.subject'),
    'title'         => trans('mail.v1_1.title'),
    'header_img'    => "img/email/headers/v1_1_" . App::getLocale() . ".png",
])

@section('content')
	<tr>
		<td style="padding-bottom: 35px">
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
                @lang('mail.v1_1.txt_1')
            </p>
            <ul style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
				<li>@lang('mail.v1_1.list.1')</li>
				<li>@lang('mail.v1_1.list.2')</li>
				<li>@lang('mail.v1_1.list.3')</li>
				<li>@lang('mail.v1_1.list.4')</li>
				<li>@lang('mail.v1_1.list.5')</li>
				<li>@lang('mail.v1_1.list.6')</li>
			</ul>
		</td>
	</tr>
	<tr>
		<td style="padding-bottom: 35px">
			<h2 style="color: #3498DB; font-weight: 300; font-size: 20px; line-height: 1.4; margin: 0;">@lang('mail.v1_1.instructions')</h2>
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
                @lang('mail.v1_1.inst_1')
            </p>
            <!--[if mso]>
                <img src="{{ asset("img/email/imgs/v1_1_domains.png") }}" valign="bottom" style="width: 460px; height: auto;" width="460" height="134">
            <![endif]-->

            <!--[if !mso]><!-- -->
				<img src="{{ asset("img/email/imgs/v1_1_domains.png") }}" valign="bottom" style="max-width: 100% !important; width: 100% !important; height: auto !important; display: block">
            <!--<![endif]-->
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
                @lang('mail.v1_1.inst_2')
            </p>
            <!--[if mso]>
                <img src="{{ asset("img/email/imgs/v1_1_links.png") }}" valign="bottom" style="width: 460px; height: auto;" width="460" height="169">
            <![endif]-->

            <!--[if !mso]><!-- -->
				<img src="{{ asset("img/email/imgs/v1_1_links.png") }}" valign="bottom" style="max-width: 100% !important; width: 100% !important; height: auto !important; display: block">
            <!--<![endif]-->
		</td>
	</tr>
	<tr>
		<td style="padding-bottom: 35px">
			<h2 style="color: #3498DB; font-weight: 300; font-size: 20px; line-height: 1.4; margin: 0;">@lang('mail.v1_1.title_2')</h2>
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
                @lang('mail.v1_1.txt_2')
            </p>
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
				<b>@lang('mail.v1_1.note'):</b>
				@lang('mail.v1_1.note_txt')
				<a href="https://morningscore.io/roadmap">morningscore.io/roadmap</a>
				(@lang('mail.v1_1.just_updated'))
			</p>
		</td>
	</tr>
    <tr>
        <td style="padding-top: 35px; padding-bottom: 35px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="button" align="center" style="-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; box-shadow: 0 4px 6px rgba(0,0,0,0.16); color: #FFFFFF" bgcolor="#3498DB">
                                    <a href="https://app.morningscore.io" target="_blank" style="font-size: 14px; letter-spacing: 1px; font-weight: 600; color: #FFFFFF; text-decoration: none; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; padding: 17px 22px; border: 1px solid #3498DB; display: inline-block; text-transform: uppercase;">@lang('mail.v1_1.button')</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
