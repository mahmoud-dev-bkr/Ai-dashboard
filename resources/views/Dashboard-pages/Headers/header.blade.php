@extends('Dashboard-layouts.app-tailwind')
@section('content')
<table class="table w-full my-4 table-zebra" id="headerDT">
    <thead>
        <tr>
            <th>Title English</th>
            <th>Title Arabic</th>
            <th>Content English</th>
            <th>Content Arabic</th>
            <th>img</th>
            <th>Action</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
@section('scripts')
<script>
       let headertDT = null;

function setheaderDT() {

    var url = "{{ route('GetHeaderData') }}";
    headertDT = $("#headerDT").DataTable({
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
                data: "title"
            },
            {
                data: "title_ar"
            },
            {
                data: "content"
            },
            {
                data: "content_ar"
            },
            {
                data: "content_img"
            },
            {
                data: "action"
            },
            {
                data: "updated_at"
            },
            
            
        ],
    });
}
$(function() {
    setheaderDT();
});
</script>
@endsection