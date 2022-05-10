@extends("Dashboard-layouts.app-tailwind")
@section('content')
    <div class="p-7">
        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Create a new Message Alert</h1>
        {!! Form::open(['route' => 'storealert', 'class' => 'form-alert']) !!}

        <div class="grid items-center w-full grid-cols-3 my-2 md:w-9/12 input-group">
            <label class="w-40">Message (en)</label>
            <input type="text" id="msg_en" class="w-full input bg-base-300/50" name="msg_en" />

        </div>

        <div class="grid items-center w-full grid-cols-3 my-2 md:w-9/12 input-group">
            <label class="w-40">Message (ar)</label>
            <input type="text" id="msg_ar" class="w-full input bg-base-300/50" name="msg_ar" />

        </div>

        <div class="grid items-center w-full grid-cols-3 my-2 md:w-9/12 input-group">
            <label class="w-40">Start Date </label>
            <input type="date" id="start_date" class="w-full input bg-base-300/50" name="start_date" />

        </div>

        <div class="grid items-center w-full grid-cols-3 my-2 md:w-9/12 input-group">
            <label class="w-40">End Date </label>
            <input type="date" id="end_date" class="w-full input bg-base-300/50" name="end_date" />
        </div>

        <div class="grid items-center w-full grid-cols-3 my-2 md:w-9/12 input-group">
            <label class="block w-40">Message Type</label>
            <select name="type" id="type" class=" select select-bordered bg-base-300/50 w-80">
                <option disabled selected>Select Type of Message</option>
                <option value="info">info</option>
                <option value="success">success</option>
                <option value="warning">warning</option>
                <option value="error">error</option>
            </select>
        </div>
        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add
            Add Message</button>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    <script type="module">
        $(document).ready(function() {
            // ////////////////////////////
            $(".form-alert").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('storealert') }}",
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
