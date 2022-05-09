@extends("Dashboard-layouts.app-tailwind")
@section('content')
<div class="p-7">
    <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Add New Password</h1>
    {!! Form::open(['route' => 'updatepassword', 'class' => 'password-form']) !!}

    {{-- @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @elseif (session('error'))
        <div class="alert alert-red" role="alert">
            {{ session('error') }}
        </div>
    @endif --}}

    <div class="items-center my-2 input-group">
            <label class="w-40">Old Password</label>
            <input type="text" class=" w-full input bg-base-300/50" name="old_password" placeholder="Enter Old Password"/>
        </div>
        {{-- @error('old_password')
            <span class="text-red">{{ $message }}</span>
        @enderror --}}

        <div class="items-center my-2  input-group">
            <label class="w-40">New Password</label>
            <input type="text" class="w-full input bg-base-300/50" name="new_password" placeholder="Enter New Password"/>
        </div>

        {{-- @error('new_password')
            <span class="text-red">{{ $message }}</span>
        @enderror --}}
        
        <div class="items-center my-2 mb-4 input-group">
            <label class="w-40">Confirm New Password</label>
            <input type="text" class="w-full input bg-base-300/50" name="new_password_confirmation" placeholder="Enter Confirm Password"/>
        </div>

        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Change Password
        </button>

    {!! Form::close() !!}
</div>
@endsection
@section('scripts')
<script>
       $(document).ready(function() {
        // ////////////////////////////

        $(".password-form").submit(function(e) {
            // $('#loader').removeClass('hidden')

            e.preventDefault();
            $.ajax({
                url: "{{ route('updatepassword') }}",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    let msg = data.success;
                    notyf.success(msg);
                },
                error: function(err) {
                    console.log(err);
                    if (err.status == 422) {
                        let message = err.responseJSON.message.split('.')[0];
                        notyf.error(message);
                    } else if (err.status == 401) {

                    }
                }
            });
        });

    });

</script>
@endsection