@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="overflow-x-auto p-7">
    <div class="my-10">
        <a href="{{ LaravelLocalization::localizeUrl(route('createSentance')) }}" class="rounded-full btn btn-info"><i
                class="fa fa-plus"></i></a>
        <span class="mx-3 text-lg font-bold">create a Sentance</span>
    </div>

    <table class="table w-full my-4 table-zebra" id="sentanceDT">
        <thead>
            <tr>
                <th>Sentance (En)</th>
                <th>Sentance (AR)</th>
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
    let usersDT = null;

    function setsenDT() {
        var url = "{{ route('GetSentaceData') }}";
        usersDT = $("#sentanceDT").DataTable({
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
                    data: "sentence_en"
                },
                {
                    data: "sentence_ar"
                },
                {
                    data: "action"
                },
                
            ],
        });
    }
    $(function() {
        setsenDT()();
    });

</script>

@endsection