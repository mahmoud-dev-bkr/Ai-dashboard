<style>
    .red {
        color: red;
    }

</style>
@if ($type == 'togglealertActive')
    @if ($active_state)
        <button onclick="toggleactivate('{{ $id }}','{{ $active_state }}')"
            class="btn btn-error">Disactive</button>
    @else
        <button onclick="toggleactivate('{{ $id }}', '{{ $active_state }}')"
            class="btn btn-primary">Active</button>
    @endif
@endif
@if ($type == 'action')
    {{-- <a class="show-alert-delete-box" href="{{ url("admin/alerts/deletealert/{$id}") }}"><i class="text-2xl fa fa-trash red me-2"></i></a> --}}
    <a href="{{ url("admin/alerts/update/{$id}") }}"><i class="text-2xl fa fa-pen text-primary"></i></a>
       
        @if (!$active_state)
            <form method="POST" action="{{ route('deletealert', $id) }}">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="text-2xl fa fa-trash red "></i></button>
            </form> 
        @endif
@endif
@if ($type == 'alert')
    <p class="bg-{{ $msg_type }}">{{ $msg_type }}</p>
@endif


<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>