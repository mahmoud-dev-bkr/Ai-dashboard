@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="p-7">
        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Create a new admin user</h1>
        {!! Form::open(['route' => 'createRole', 'class' => 'form-role']) !!}

        <span class="font-light text-gray-500"><i class="fa fa-info"></i> Role name can contains "_" or "-" but not
            spaces</span>
        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Role Name (without spaces)</label>
            <input type="text" class="input bg-base-300/50" name="name" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Role Display name</label>
            <input type="text" class="input bg-base-300/50" name="display_name" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-80">Note (optional)</label>
            <input type="text" class="input bg-base-300/50" name="note" />
        </div>

        <h1 class="font-bold">Permissions</h1>

        @foreach ($permissions as $p)
            <div class="flex items-center my-2">
                <input type="checkbox" class="mx-3 checkbox" value="{{ $p->id }}" name="permissions[]" />
                <label>{{ $p->display_name }}</label>
            </div>
        @endforeach



        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add
            Role</button>

        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            // ////////////////////////////

            $(".form-role").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('createRole') }}",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);

                        let msg = data.msg;
                        notyf.success(msg);
                    },
                    error: function(err) {
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
