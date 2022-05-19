@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="p-7">

    <div class="my-4">
        <a href="{{ LaravelLocalization::localizeUrl(route('createFaq')) }}" class="rounded-lg btn btn-info">
            <i class="fa fa-plus"></i>
            <span class="mx-3 text-lg font-bold">write a new FAQ</span>
        </a>
    </div>
</div>

<div class="p-7">
    <h1 class="my-3 text-3xl font-bold text-priamry">FAQ</h1>

    <div class="mt-5 terms">
        @foreach ($faq as $t)

            <div class="p-4 my-4 overflow-x-auto bg-white rounded-lg shadow-lg">
                <div>
                    <div class="flex items-center justify-between">
                        <a href="{{url("admin/faq/update/$t->id")}}"><i class="fa fa-pen"></i></a>
                    </div>
                    <div class="flex items-center justify-between">
                        <form method="POST" action="{{ route('deletefaq', $t->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="text-2xl fa fa-trash text-red "></i></button>
                        </form>
                        
                    </div>
                </div>
                <h1 class="mb-3 text-2xl text-blue-500">{{ $t->title }}</h1>
                <p style="white-space: pre-wrap;">{{ $t->paragraph }}</p>

                <h1 class="mb-3 text-2xl text-blue-500">{{ $t->title_ar }}</h1>
                <p style="white-space: pre-wrap;">{{ $t->paragraph_ar }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
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
@endsection
