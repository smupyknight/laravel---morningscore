@extends(Context::view('layouts.page'))
@section('content')

    <div class="setup-form-outer">
    
        <div class="form-content setup-form">

			{!! React::component('UserSetup') !!}

        </div>
        
    </div>

@stop
