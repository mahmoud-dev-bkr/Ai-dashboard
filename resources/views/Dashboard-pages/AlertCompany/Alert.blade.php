@extends("Dashboard-layouts.app-tailwind")
@section('content')
    <div class="overflow-x-auto p-7">

        @if (Auth::user()->hasPermission('notifications_add'))

            <div class="my-10">
                <a href="{{ LaravelLocalization::localizeUrl(route('insertalertmessage')) }}"
                    class="rounded-full btn btn-info"><i class="fa fa-plus"></i></a>
                <span class="mx-3 text-lg font-bold">create a new Alert</span>
            </div>
        @endif
        @if (Auth::user()->hasPermission('notifications_view'))
            <table class="table w-full my-4 table-zebra" id="comalertDT">
                <thead>
                    <tr>
                        <th>Message English</th>
                        <th>Message Arabic</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Created By</th>
                        <th>Message Type</th>
                        <th>Company Name</th>

                        @if (Auth::user()->hasPermission('notifications_activate'))
                            <th>Activate</th>
                        @endif
                        @if (Auth::user()->hasPermission('notifications_delete'))
                            <th>Delete</th>
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
        let alertcomapnyDt = null;

        function setalertcomapnyDt() {
            var url = "{{ route('getAlertCompanyData') }}";
            alertcomapnyDt = $("#comalertDT").DataTable({
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
                        data: "message_en"
                    },
                    {
                        data: "message_ar"
                    },
                    {
                        data: "start_date"
                    },
                    {
                        data: "end_date"
                    },
                    {
                        data: "username"
                    },
                    {
                        data: "type"
                    },
                    {
                        data: "company_name"
                    },
                    @if (Auth::user()->hasPermission('notifications_activate'))
                    
                        {
                        data: "isActive"
                        },
                    @endif
                    @if (Auth::user()->hasPermission('notifications_delete'))
                        {
                        data: "delete"
                        }
                    @endif

                ],
            });
        }
        $(function() {
            setalertcomapnyDt();
        });
        const togglealertactivate = (id, activeState) => {
            // alert(activeState);
            (async () => {
                try {
                    const rawResponse = await fetch('{{ route('togglealertcompanyactivate') }}', {
                        method: 'PATCH',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            active_state: activeState
                        })
                    });
                    const content = await rawResponse.json();
                    console.log(content);
                    notyf.success(content.msg);
                    alertcomapnyDt.ajax.reload()
                } catch (err) {
                    console.log(err);
                }
            })
            ();
        }

    </script>
@endsection
