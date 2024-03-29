@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="overflow-x-auto p-7">
        @if (Auth::user()->hasPermission('plans_add'))
            <div class="my-10">
                <a href="{{ LaravelLocalization::localizeUrl(route('insertPlanPage')) }}"
                    class="rounded-full btn btn-info"><i class="fa fa-plus"></i></a>
                <span class="mx-3 text-lg font-bold">create a new Plan</span>
            </div>
        @endif

        @if (Auth::user()->hasPermission('plans_view'))

            <table class="table w-full my-4 table-zebra" id="usersDT">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Max Employee</th>
                        <th>Cost</th>
                        <th>Duration Day</th>
                        <th>Status</th>
                        <th>Added by</th>
                        <th>Last edit by</th>
                        @if (Auth::user()->hasPermission('plans_edit'))
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        let usersDT = null;

        function setusersDT() {
            var url = "{{ route('getPlansData') }}";
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
                        data: "max_emp"
                    },
                    {
                        data: "coast"
                    },
                    {
                        data: "duration_days"
                    },
                    {
                        data: "activate"
                    },
                    {
                        data: "admin"
                    },
                    {
                        data: "edit"
                    },
                    @if (Auth::user()->hasPermission('plans_edit'))
                    
                        {
                        data: 'action'
                        }
                    @endif

                ],
            });
        }
        $(function() {
            setusersDT();
        });

    </script>

@endsection
