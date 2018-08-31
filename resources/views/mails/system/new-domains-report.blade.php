@extends('mails.template', [
    'subject'       => 'New Domains Report',
    'title'       	=> 'New Domains Report',
])

@section('content')
	<tr>
		<td colspan="2" style="padding-bottom: 20px">
			<p style="color: #95989A; font-weight: 100; font-size: 13px; line-height: 1.45; margin: 0">
			{{ $domains->count() }} new Domains were created in the last 24 hours:
			</p>
			@foreach($domains as $domain)
				<ul>
					<li style="color: #95989A; font-weight: 100; font-size: 13px; line-height: 1.45; margin: 0">
						{{ $domain->domain }} in {{ $domain->locale }}
					</li>
				</ul>
			@endforeach
		</td>
	</tr>
@endsection
