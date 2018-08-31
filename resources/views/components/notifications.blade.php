@if(count($errors))
    {!! React::component('Notifications', [
        'type' => 'error',
        'message' => $errors->first()

    ], ['ref' => 'notifications']) !!}

@elseif(Session::has('status'))
    {!! React::component('Notifications', [
        'type' => 'success',
        'message' => Session::pull('status')

    ], ['ref' => 'notifications']) !!}

@else
    {!! React::component('Notifications', [], ['ref' => 'notifications']) !!}

@endif