@extends("Dashboard-layouts.app-tailwind");
@section('content')
<div class="p-7">
    <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Create a new Message Alert</h1>
    {!! Form::open(['route' => 'storepaymentmethod', 'class' => 'form-paymentmethod']) !!}

    <div class="items-center my-2 input-group">
        <label class="w-40">Name</label>
        <input type="text" id="name" class="w-full input bg-base-300/50" name="name" />
    </div>


    <div class="items-center my-2 input-group">
        <label class="w-40">Details</label>
        <input type="text" id="details" class="w-full input bg-base-300/50" name="details" />
    </div>

    <div class="items-center my-2 input-group">
        <label class="w-40">Note</label>
        <textarea name="note" id="note" class="w-full input bg-base-300/50" cols="30" rows="100"></textarea>
    </div>
    
    <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add
        Add Payment Method</button>
    {!! Form::close() !!}
</div>
@endsection
@section('scripts')
<script type="module">
    $(document).ready(function() {
        // ////////////////////////////
        $(".form-paymentmethod").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('storepaymentmethod') }}",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    // $('#loader').addClass('hidden')

                    console.log(data);
                    let msg = data.msg;
                    notyf.success(msg);
                },
                error: function(err) {
                    // $('#loader').addClass('hidden')

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