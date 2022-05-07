@if ($active_state == 0)
<button onclick="toggleactivate('{{$id}},{{$active_state}}')" class="btn btn-primary">Active</button>
@else
<button onclick="toggleactivate('{{$id}}','{{$active_state}}')" class="btn btn-error">Disactive</button>    
@endif

{{-- @foreach ( $paymentmethod as $pay )
<input data-id="{{$pay->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
 data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $pay->isActive ? 'checked' : '' }}>    
@endforeach --}}
