@extends('mails.template', [
    'subject'       => trans('mail.v1_2.subject'),
    'title'         => 'YOUR BETA ACCESS IS HERE',
    'header_img'    => "img/email/headers/team.jpg",
])

@section('content')
    <tr>
        <td style="padding-top: 15px; padding-bottom: 15px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="button" align="center" style="-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; box-shadow: 0 4px 6px rgba(0,0,0,0.16); color: #FFFFFF" bgcolor="#3498DB">
                                    <a href="https://app.morningscore.io" target="_blank" style="font-size: 14px; letter-spacing: 1px; font-weight: 600; color: #FFFFFF; text-decoration: none; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; padding: 17px 22px; border: 1px solid #3498DB; display: inline-block; text-transform: uppercase;">@lang('mail.v1_2.button')</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

	<tr>
		<td style="padding-bottom: 35px">
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
                Click the button to create a user with email and password or by using Google or Facebook login.
            </p>
		</td>
	</tr>

	<tr>
		<td style="padding-bottom: 35px">
			<h2 style="color: #3498DB; font-weight: 300; font-size: 20px; line-height: 1.4; margin: 0;">@lang('mail.v1_2.title_2')</h2>
            <ul style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
				<li>@lang('mail.v1_2.list_1.1')</li>
				<li>@lang('mail.v1_2.list_1.2')</li>
			</ul>
		</td>
	</tr>

	<tr>
		<td>
			<h2 style="color: #3498DB; font-weight: 300; font-size: 20px; line-height: 1.4; margin: 0;">@lang('mail.v1_2.title_4')</h2>
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
                @lang('mail.v1_2.txt_4')
            </p>
            <ul style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
				<li>@lang('mail.v1_2.list_2.1')</li>
				<li>@lang('mail.v1_2.list_2.2')</li>
				<li>@lang('mail.v1_2.list_2.3')</li>
			</ul>
            <p style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
                @lang('mail.v1_2.txt_5')
            </p>
		</td>
	</tr>
@endsection
