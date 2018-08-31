@extends('mails.template', [
    'subject'       => trans('mail.reset_password.subject'),
    'header_img'    => 'img/email/header-mail.jpg',
    'title'         => trans('mail.reset_password.title'),
])

@section('content')
    <tr>
        <td style="padding-top: 20px; padding-bottom: 20px">
            <p style="color: #666666; font-weight: 200; font-size: 16px; line-height: 1.45; margin: 0">@lang('mail.reset_password.body')</p>
        </td>
    </tr>
    <!-- Tagline -->
    <tr>
        <td>
            <div style="color: #3498DB; font-weight: 400; font-size: 16px;">@lang('mail.reset_password.ending')</div>
        </td>
    </tr>
    <!-- Button -->
    <tr>
        <td style="padding-top: 20px; padding-bottom: 35px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="button" align="center" style="-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; box-shadow: 0 4px 6px rgba(0,0,0,0.16); color: #FFFFFF" bgcolor="#3498DB">
                                    <a href="{{ $link }}" target="_blank" style="font-size: 14px; letter-spacing: 1px; font-weight: 600; color: #FFFFFF; text-decoration: none; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; padding: 17px 22px; border: 1px solid #3498DB; display: inline-block;">@lang('mail.reset_password.link')</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
