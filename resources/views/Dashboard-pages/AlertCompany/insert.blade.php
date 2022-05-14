@extends('Dashboard-layouts.app-tailwind')
@section('content')

    <div class="p-7">
        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Send new Message Alert</h1>
        {!! Form::open(['route' => 'storealertmsg', 'class' => 'form-alertcompany']) !!}
        <div class="grid items-center w-full grid-cols-3 my-2 md:w-9/12 ">
            <label class="block w-40">Company Name</label>
            <select multiple="multiple" name="company[]" id="company"
                class="js-select2-multi select select-bordered bg-base-300/50 w-80">
                @foreach ($company as $com)
                    <option value="{{ $com->id }}">{{ $com->name_en }}</option>
                @endforeach
            </select>
        </div>


        <div class="grid items-center w-full grid-cols-3 my-2 md:w-9/12 ">
            <label class="block w-40">Select Message</label>
            <select multiple name="alerts[]" id="msg" class="js-select2-multi select-bordered bg-base-300/50 w-80">
                @foreach ($message as $msg)
                    <option value="{{ $msg->id }}">{{ $msg->message_en }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Send
            New Message</button>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    <script type="module">
        $(document).ready(function() {
            // ////////////////////////////

            $(".form-alertcompany").submit(function(e) {
                e.preventDefault();
                $('#loader').removeClass('hidden')
                $.ajax({
                    url: "{{ route('storealertmsg') }}",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        $('#loader').addClass('hidden')

                        let msg = data.msg;
                        notyf.success(msg);
                    },
                    error: function(err) {
                        $('#loader').addClass('hidden')

                        console.log(err);
                        if (err.status == 422) {
                            // validation error
                            let message = err.responseJSON.message.split('.')[0]
                            notyf.error(message);
                        }
                    }
                });
            });

        });

    </script>
@endsection
