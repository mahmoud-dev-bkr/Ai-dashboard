@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="overflow-x-auto p-7">
    <div class="my-10">
        <a href="{{ LaravelLocalization::localizeUrl(route('insertreviews')) }}" class="rounded-full btn btn-info"><i
                class="fa fa-plus"></i></a>
        <span class="mx-3 text-lg font-bold">create a new Reviews</span>
    </div>

    <table class="table w-full my-4 table-zebra" id="usersDT">
        <thead>
            <tr>
                <th>Rate</th>
                <th>Title</th>
                <th>Paragraph</th>
                <th>Owner</th>
                <th>Company Name</th>
                <th>Actions</th>
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
            var url = "{{ route('GetReviewsData') }}";
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
                        data: "rate"
                    },
                    {
                        data: "title"
                    },
                    {
                        data: "paragraph"
                    },
                    {
                        data: "owner"
                    },
                    {
                        data: "supporter"
                    },
                    {
                        data: "action"
                    },
                    
                ],
            });
        }
        $(function() {
            setusersDT();
        });

    </script>
    
@endsection