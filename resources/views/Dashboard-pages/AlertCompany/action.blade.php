@if ($type == 'togglealertActive')
<input type="checkbox" onchange="toggleActivation(event , '{{ $id }}')" class="toggle" name="active"
{{ $active_state ? 'checked' : '' }} />
@endif
@if ($type == 'action')
    {{-- <a class="show-alert-delete-box" href="{{ url("admin/alerts/deletealert/{$id}") }}"><i class="text-2xl fa fa-trash red me-2"></i></a> --}}     
        @if (!$active_state)
            <form method="POST" action="{{ route('deletealertcompany', $id) }}">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="text-2xl fa fa-trash text-red "></i></button>
            </form> 
        @endif
@endif

<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this Alert Message?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#4637a0',
            cancelButtonColor: 'red',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>