@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="p-10">

        <table class="table w-full my-4 table-zebra" id="usersDT">
            <thead>
                <tr>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        let usersDT = null;

        function setusersDT() {
            var url = "{{ route('getUsersData') }}";
            usersDT = $("#usersDT").DataTable({
                processing: true,
                serverSide: true,
                pageLength: 7,
                dom: "Bfrtip",
                buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
                sorting: [0, "DESC"],
                ajax: url,

                language: {
                    paginate: {
                        "previous": "<i class='text-lg cursor-pointer fa text-secondary fa-caret-left'></i>",
                        "next": "<i class='text-lg cursor-pointer fa text-secondary fa-caret-right'></i>",
                    },
                },

                columns: [{
                        data: "email"
                    },

                ],
            });
        }
        $(function() {
            setusersDT();
        });

    </script>
@endsection
