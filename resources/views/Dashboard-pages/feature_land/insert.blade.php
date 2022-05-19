@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="p-7">
    <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Create a new Reviews</h1>
    {!! Form::open(['route' => 'store_feature_land', 'class' => 'form-features']) !!}
    <div class="items-center my-2 input-group">
        <label class="w-40">Title (en)</label>
        <input type="text" class="input bg-base-300/50" name="title_en" placeholder="Enter Title in (En)"/>
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Content (en)</label>
        <textarea name="body_en"  class="w-full textarea h-80 bg-base-300/50 arabic" placeholder="Enter Paragraph in (En)"></textarea>
    </div>
    

    <div class="items-center my-2 input-group">
        <label class="w-40">Title (ar)</label>
        <input type="text" class="input bg-base-300/50" name="title_ar" placeholder="Enter Title in (En)"/>
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Content (ar)</label>
        <textarea name="body_ar"  class="w-full textarea h-80 bg-base-300/50 arabic" placeholder="Enter Paragraph in (En)"></textarea>
    </div>
    

    <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add
        Profile Features </button>

    {!! Form::close() !!}
</div
@endsection

@section('scripts')
<script type="module">
    $(document).ready(function() {
        // ////////////////////////////
        $(".form-features").submit(function(e) {
            e.preventDefault();
            $('#loader').removeClass('hidden')
            $.ajax({
                url: "{{ route('store_feature_land') }}",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#loader').addClass('hidden')

                    console.log(data);
                    let msg = data.msg;
                    notyf.success(msg);
                    window.location = '/admin/features_land';
                },
                error: function(err) {
                    $('#loader').addClass('hidden')

                    if (err.status == 422) {
                        // validation error
                        let message = err.responseJSON.message.split('.')[0]
                        notyf.error(message);
                    } else if (err.status == 401) {

                    }
                }
            });
        });

    });

</script>

@endsection
