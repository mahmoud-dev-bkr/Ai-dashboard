@if ($type == 'togglePMethodsActive')
    @if ($active_state)
        <button onclick="toggleactivate('{{$id}}','{{$active_state}}')" class="btn btn-error">Disactive</button>    
    @else
        <button onclick="toggleactivate('{{$id}}', '{{$active_state}}')" class="btn btn-primary">Active</button>
    @endif
@endif