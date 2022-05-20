@extends('dashboard-layouts.app-tailwind')

@section('content')

    <div class="overflow-x-auto p-7">



        @if (Auth::user()->hasPermission('roles_permissions_add'))
            <div class="my-10">
                <a href="{{ LaravelLocalization::localizeUrl(route('insertRolePage')) }}" class="rounded-lg btn btn-info">
                    <i class="fa fa-plus"></i>
                    <span class="mx-3 text-lg font-bold">create a new Role</span>
                </a>
            </div>
        @endif
        @if (Auth::user()->hasPermission('roles_permissions_view'))

            <table class="table w-full my-4" id="rolesDt">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>users</th>
                        @if (Auth::user()->hasPermission('roles_permissions_update'))
                            <th>actions</th>
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
        let rolesDt = null;

        function setrolesDt() {
            var url = "{{ route('getRulesData') }}";
            rolesDt = $("#rolesDt").DataTable({
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
                        data: "display_name"
                    },
                    {
                        data: "users"
                    },
                    @if (Auth::user()->hasPermission('roles_permissions_update'))
                    
                        {
                        data: "actions"
                        }
                    @endif
                ],
            });
        }
        $(function() {
            setrolesDt();
        });

    </script>
@endsection
