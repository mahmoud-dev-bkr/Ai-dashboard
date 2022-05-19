@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="p-7">
    <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Create a new Reviews</h1>
    {!! Form::open(['route' => 'storeReviews', 'class' => 'form-reviews']) !!}
    <div class="items-center my-2 input-group">
        <label class="w-40">Rate (en)</label>
        <input type="number" class="input bg-base-300/50" name="rate" placeholder="Enter Rate"/>
    </div>
    <div class="items-center my-2 input-group">
        <label class="w-40">Title (en)</label>
        <input type="text" class="input bg-base-300/50" name="title_en" placeholder="Enter Title in (En)"/>
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Paragraph (en)</label>
        <textarea name="body_en"  class="w-full textarea h-80 bg-base-300/50 arabic" placeholder="Enter Paragraph in (En)"></textarea>
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Owner(en)</label>
        <input type="text" class="input bg-base-300/50" name="owner_en" placeholder="Enter Name of Owner"/>
    </div>
    
    
    <div class="items-center my-2 input-group">
        <label class="w-40">Company (en)</label>
        <input type="text" class="input bg-base-300/50" name="company_en" placeholder="Enter Company Name"/>
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Title (ar)</label>
        <input type="text" class="input bg-base-300/50" name="title_ar" placeholder="Enter Title in (En)"/>
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Paragraph (ar)</label>
        <textarea name="body_ar"  class="w-full textarea h-80 bg-base-300/50 arabic" placeholder="Enter Paragraph in (En)"></textarea>
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Owner (ar)</label>
        <input type="text" class="input bg-base-300/50" name="owner_ar" placeholder="Enter Name of Owner"/>
    </div>
    
    
    <div class="items-center my-2 input-group">
        <label class="w-40">Company (ar)</label>
        <input type="text" class="input bg-base-300/50" name="company_ar" placeholder="Enter Company Name"/>
    </div>

    

    <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add
        Plan</button>

    {!! Form::close() !!}
</div
@endsection

@section('scripts')
<script type="module">
    $(document).ready(function() {
        // ////////////////////////////
        $(".form-reviews").submit(function(e) {
            e.preventDefault();
            $('#loader').removeClass('hidden')
            $.ajax({
                url: "{{ route('storeReviews') }}",
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
                    {{-- window.location = '/admin/reviews'; --}}
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
