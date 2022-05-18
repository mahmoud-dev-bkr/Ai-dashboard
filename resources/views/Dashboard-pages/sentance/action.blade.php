@if ($type == 'sentance')
<form method="POST" action="{{ route('deletesentace', $id) }}">
    @csrf
    <input name="_method" type="hidden" value="DELETE">
    <button type="submit" class="show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="text-2xl fa fa-trash text-red "></i></button>
</form> 
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