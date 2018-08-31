<!-- Header -->
@isset($title)
    <tr>
        <td colspan="2" style="padding-bottom: 20px">
			<h2 style="color: #3498DB; font-weight: 300; font-size: 20px; line-height: 1.4; margin: 0;">
                {{ $title }}
            </h2>
        </td>
    </tr>
@endisset

<!-- Content -->
@isset($paragraphs)
    @foreach($paragraphs as $p)
        <tr>
            <td colspan="2" style="padding-bottom: 20px">
				<p style="color: #666666; font-weight: 200; font-size: 16px; line-height: 1.45; margin: 0">
                    {!! $p !!}
                </p>
            </td>
        </tr>
    @endforeach
@endisset

<!-- List -->
@isset($list)
	<tr>
		<td colspan="2" style="padding-bottom: 20px">
			<ul style="color: #666666; font-weight: 300; font-size: 16px; line-height: 1.45">
			@foreach($list as $l)
				<li>{!! $l !!}</li>
			@endforeach
			</ul>
		</td>
	</tr>
@endisset

<!-- Footer -->
@isset($subtitle)
    <tr>
        <td colspan="2" style="padding-bottom: 20px">
			<h3 style="color: #3498DB; font-weight: 400; font-size: 16px; line-height: 1.4; margin: 0;">
                {{ $subtitle }}
            </h3>
        </td>
    </tr>
@endisset
