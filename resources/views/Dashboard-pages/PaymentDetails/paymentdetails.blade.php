@extends('dashboard-layouts.app-tailwind')
@section('content')
    <div class="overflow-x-auto p-7">
        @if (Auth::user()->hasPermission('payment_details_add'))
            <div class="my-10">
                <a href="{{ LaravelLocalization::localizeUrl(route('addpaymentdetails')) }}"
                    class="rounded-full btn btn-info"><i class="fa fa-plus"></i></a>
                <span class="mx-3 text-lg font-bold">create Payment Manually</span>
            </div>
        @endif

        @if (Auth::user()->hasPermission('payment_details_view'))

            <table class="table w-full my-4 table-zebra" id="paymentdetailstDT">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Plan Name</th>
                        <th>Payment Method</th>
                        <th>Payment Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        @if (Auth::user()->hasPermission('payment_details_edit'))
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
        let paymentdetailstDT = null;

        function setpaymentdetailsDT() {

            var url = "{{ route('getpaymentdetailsData') }}";
            paymentdetailstDT = $("#paymentdetailstDT").DataTable({
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
                        data: "company_name"
                    },
                    {
                        data: "plan_name"
                    },
                    {
                        data: "payment_method"
                    },
                    {
                        data: "pay_date"
                    },
                    {
                        data: "start_date"
                    },
                    {
                        data: "end_date"
                    },
                    @if (Auth::user()->hasPermission('payment_details_edit'))
                    
                        {
                        data: "action"
                        }
                    @endif
                ],
            });
        }
        $(function() {
            setpaymentdetailsDT();
        });

    </script>
@endsection
