@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="overflow-x-auto p-7">

        <table class="table w-full my-4 table-zebra" id="usersDT">
            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>Telephone 1</th>
                    <th>Telephone 2</th>
                    <th>Telephone 3</th>
                    <th>Role(s)</th>
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
                        data: "name_en"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "Tel_1"
                    },
                    {
                        data: "Tel_2"
                    },
                    {
                        data: "Tel_3"
                    },
                    {
                        data: "roles"
                    }

                ],
            });
        }
        $(function() {
            setusersDT();
        });

    </script>
@endsection
