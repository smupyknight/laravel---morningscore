<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html style="min-height: 100%">
<head>
    <meta http-equiv="Content-Type" content="text/html">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style type="text/css" media="screen">
        @media screen {
            @font-face {
                font-family: 'Montserrat';
                font-style: normal;
                font-weight: 200;
                src: local('Montserrat ExtraLight'), local('Montserrat-ExtraLight'), url(https://fonts.gstatic.com/s/montserrat/v10/eWRmKHdPNWGn_iFyeEYja_bbaTZmtPDRvp9xUdyvPg4.woff2) format('woff2');
            }
            @font-face {
                font-family: 'Montserrat';
                font-style: normal;
                font-weight: 300;
                src: local('Montserrat Light'), local('Montserrat-Light'), url(https://fonts.gstatic.com/s/montserrat/v10/IVeH6A3MiFyaSEiudUMXEweOulFbQKHxPa89BaxZzA0.woff2) format('woff2');
            }
            @font-face {
                font-family: 'Montserrat';
                font-style: normal;
                font-weight: 400;
                src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v10/zhcz-_WihjSQC0oHJ9TCYAzyDMXhdD8sAj6OAJTFsBI.woff2) format('woff2');
            }
        }
        .button {
            transition: .2s ease all;
        }
        .button:hover {
            background-color: #308DCC !important;
        }
        .button a:visited {
            color: #FFFFFF !important;
        }
        .button:hover a {
            border-color: #308DCC !important;
        }
        @media (max-width: 700px) {
            body {
                overflow-x: hidden !important;
            }
            .middle {
                width: 100% !important;
            }
            .content-container {
                padding: 20px 5% !important;
            }
            .outer-table {
                padding: 20px 0 !important;
            }
            .hide-mobile {
                display: none !important;
            }
            .hide-image {
                width: 1px !important;
            }
            .hide-image img {
                display: none;
            }
            h1 {
                font-size: 20px !important;
            }
        }
        @media (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        span.MsoHyperlink {
            mso-style-priority:99;
            color: #FFFFFF;
        }
        span.MsoHyperlinkFollowed {
            mso-style-priority:99;
            color: #FFFFFF;
        }
    </style>
</head>
<body style="background-color: #F5F9FC; height: 100%; font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', 'Verdana', sans-serif;">
<!--[if mso]>
    <style type="text/css">
        body, table, td {font-family: 'Montserrat', Helvetica, Arial, sans-serif !important;}
    </style>
<![endif]-->
<table style="width: 100%; height: 100%; padding: 25px 0; table-layout:fixed;" class="outer-table">
    <tbody>
    <tr>
        <td style="padding: 0;">
            <!--[if mso]>
                <table style="width: 550px; height: 80%; max-width: 100%" align="center" class="middle">
            <![endif]-->
            <!--[if !mso]><!-- -->
            <table style="width: 90%; height: 80%; max-width: 800px" align="center" class="middle" data-name="not-ie">
                <!--<![endif]-->
                <tbody style="height: 100%;">
                <tr class="hide-mobile">
                    <td style="padding: 0;"></td>
                    <td style="padding: 0; width: 70px;" align="right"><img src="{{ asset('img/email/top-left.png') }}"></td>
                    <td style="padding: 0; width: 90%; padding-left: 7px" class="middle"><img src="{{ asset('img/email/top.png') }}"></td>
                    <td style="padding: 0; width: 70px;"></td>
                    <td style="padding: 0;"></td>
                </tr>
                <tr style="height: 100%;">
                    <td style="padding: 0;" class="hide-mobile"></td>
                    <td style="padding: 0; width: 70px; padding-top: 5px" align="right" valign="top" class="hide-image">
                        <img src="{{ asset('img/email/left.png') }}">
                    </td>
                    <td style="padding: 0; width: 90%; height: 100%; box-shadow: 0 6px 30px rgba(0,0,0,0.10);" bgcolor="#FFFFFF" class="middle">
                        <table style="width: 100%; height: 100%; border-collapse: collapse; table-layout:fixed">
                            <tbody style="height: 100%;">
							@if( isset($header_img) )
								<tr>
									<td style="padding: 0;">
										<!--[if mso]>
											<img src="{{ asset($header_img) }}" valign="bottom" style="width: 550px; height: auto;" width="550" height="294.55">
										<![endif]-->

										<!--[if !mso]><!-- -->
										<img src="{{ asset($header_img) }}" valign="bottom" style="max-width: 100% !important; width: 100% !important; height: auto !important; display: block">
										<!--<![endif]-->
									</td>
								</tr>
							@endif
                            <tr>
                                <!--[if mso]>
                                    <td style="padding: 40px;" class="content-container">
                                <![endif]-->
                                <!--[if !mso]><!-- -->
                                <td style="padding: 40px 12%;" class="content-container">
                                    <!--<![endif]-->
                                    <table>
                                        <tbody>
                                        <!-- Header -->
                                        <tr>
                                            <td style="padding-bottom: 20px">
                                                <h1 style="color: #3498DB; font-weight: 300; font-size: 25px; line-height: 1.4; margin: 0;">{{ $title }}</h1>
												@if ( isset($sub_title) )
                                                    <h3>{{$sub_title}}<h3>
												@endif
                                            </td>
                                        </tr>
                                        <!-- Content -->
										@yield('content')
                                        <!-- Regards -->
                                        <tr>
                                            <td>
                                                <p style="color: #666666; font-size: 14px; text-decoration: none; font-weight: 200; margin: 0">
                                                    @lang('mail.regards'),<br/>
                                                    @lang('mail.sender')
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding: 0; width: 70px" valign="bottom" class="hide-image"><img src="{{ asset('img/email/right.png') }}"></td>
                    <td style="padding: 0;" class="hide-mobile"></td>
                </tr>
                <tr class="hide-mobile">
                    <td></td>
                    <td style="padding: 0; width: 70px"></td>
                    <td style="padding: 0; width: 90%" align="right" class="middle"><img src="{{ asset('img/email/bottom.png') }}"></td>
                    <td style="padding: 0; width: 70px"><img src="{{ asset('img/email/bottom-right.png') }}"></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
