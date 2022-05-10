@extends("Dashboard-layouts.app-tailwind")
@section('content')
<div class="overflow-x-auto p-7">
    <div class="my-10">
        <a href="{{ LaravelLocalization::localizeUrl(route('insertalertPage')) }}" class="rounded-full btn btn-info"><i
                class="fa fa-plus"></i></a>
        <span class="mx-3 text-lg font-bold">create a new Alert</span>
    </div>

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
                <th>Activate</th>     
                <th>Action</th>
            
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
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

            columns:
             [
                 {
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
                    data: "created_by"
                },
                {
                    data: "type"
                },
                {
                    data:"compname"
                },
                {
                    data: "isActive"
                },
            ],
        });
    }
    $(function() {
        setalertcomapnyDt();
    });

</script>
@endsection