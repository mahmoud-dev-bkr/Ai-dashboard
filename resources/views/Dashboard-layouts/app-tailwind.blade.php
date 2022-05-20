<!DOCTYPE html>
<html lang={{ LaravelLocalization::getCurrentLocale() }}
    dir={{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : 'ltr' }} data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/app.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- inline styles --}}
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        .arabic {
            font-family: 'Droid Arabic Kufi', serif;
        }

        html {
            font-size: 17px !important
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 5px;
            height: 7px;
        }

        ::-webkit-scrollbar-track {
            background-color: #e2dff3;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: rgb(8, 46, 121);

        }

        .dataTables_empty {
            background-color: rgb(55, 48, 163);

            color: white;
            padding: 5px 10px;
            display: inline;
            text-align: center;
        }

        .dataTables_paginate {
            float: right;
            display: flex;
            align-items: center;
        }

        .dataTables_processing {
            position: absolute;
            left: 50%;
            top: 10%;
            transform: translateX(50%);
            background: rgb(213, 213, 235);
            font-weight: bold;
            font-size: 1.3rem;
            padding: 7px 1rem;
            z-index: 9999;
            border-radius: 15px;
        }


        .dataTables_filter input {
            padding: 10px 5px;
            margin: 0 1rem;
            border-radius: 7px;
            border: 1px solid #eeee;
            outline: 0;
            background-color: rgba(218, 222, 236, 0.933)
        }


        .dataTables_paginate>* {
            margin: 0 7px;
        }

        .dataTables_paginate span>* {
            margin: 0 7px;
            cursor: pointer;
            padding: 5px 7px;
            /* font-weight: bolder */
        }

        .dataTables_paginate span>*:hover {}

        .dataTables_paginate span>*.current {
            text-decoration: underline;
            font-weight: bolder
        }


        .dashboard-item-active {
            border-right: 5px solid white;
            border-bo-radius: 4px;
            border-bottom-right-radius: 2px;
        }

        .input {
            outline-offset: 0px !important;
            outline-color: #45369e !important;
            border-radius: 15px !important;

        }

        .table thead th:first-child {
            position: relative !important;
        }

        .table th {
            background: rgb(79, 70, 229);
            color: white
        }

        .table td {
            background: transparent !important;
        }

        .table td.dataTables_empty {
            background-color: rgb(189, 61, 61) !important;
            color: white;
            padding: 5px 10px;
            display: inline;
            text-align: center;
        }

        .table tr {
            border-bottom: .5px solid #e9ecef !important;
        }




        .sidebar-items svg {
            float: left;
        }

        .toggle {
            background-color: #adc9eb !important;
            border-color: #1a75e4
        }

        .toggle:checked {
            background-color: #1a75e4 !important;
        }

        /* select 2 */
        .select2.select2-container {
            width: 100% !important;
        }

        .select2.select2-container .select2-selection {
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            height: 34px;
            margin-bottom: 15px;
            outline: none !important;
            transition: all .15s ease-in-out;
        }

        .select2.select2-container .select2-selection .select2-selection__rendered {
            color: #333;
            line-height: 32px;
            padding-right: 33px;
        }

        .select2.select2-container .select2-selection .select2-selection__arrow {
            background: #f8f8f8;
            border-left: 1px solid #ccc;
            -webkit-border-radius: 0 3px 3px 0;
            -moz-border-radius: 0 3px 3px 0;
            border-radius: 0 3px 3px 0;
            height: 32px;
            width: 33px;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
            background: #f8f8f8;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
            -webkit-border-radius: 0 3px 0 0;
            -moz-border-radius: 0 3px 0 0;
            border-radius: 0 3px 0 0;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
            border: 1px solid #34495e;
        }

        .select2.select2-container .select2-selection--multiple {
            height: auto;
            min-height: 34px;
        }

        .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
            margin-top: 0;
            height: 32px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
            display: block;
            padding: 0 4px;
            line-height: 29px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin: 4px 4px 0 0;
            padding: 0 6px 0 22px;
            height: 24px;
            line-height: 24px;
            font-size: 12px;
            position: relative;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
            position: absolute;
            top: 0;
            left: 0;
            height: 22px;
            width: 22px;
            margin: 0;
            text-align: center;
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
        }

        .select2-container .select2-dropdown {
            background: transparent;
            border: none;
            margin-top: -5px;
        }

        .select2-container .select2-dropdown .select2-search {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-search input {
            outline: none !important;
            border: 1px solid #34495e !important;
            border-bottom: none !important;
            padding: 4px 6px !important;
        }

        .select2-container .select2-dropdown .select2-results {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-results ul {
            background: #fff;
            border: 1px solid #34495e;
        }

        .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
            background-color: #3498db;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('/css/notyf.min.css') }}">

    @yield('cdnStyle')
    @yield('styles')

</head>

<body>
    <div class="flex flex-col md:flex-row">
        @include('dashboard-layouts.inc.sidebar')
        <div class="w-full h-auto opacity-0 bg-blue-100/50 md:h-screen md:overflow-auto" id="content-view">
            {{-- navbar --}}
            @include('dashboard-layouts.inc.navbar')
            {{-- <div class="h-40 bg-gradient-to-r from-sky-500 to-indigo-500" style="z-index: -1"></div> --}}
            <div class="h-auto m-4 bg-white rounded-lg shadow-2xl md:flex-1 p-7 drop-shadow-lg ">
                @yield('content')
            </div>
        </div>
    </div>
    {{-- sweet alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    {{-- data tables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{-- font awesome --}}
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    {{-- nofty --}}
    <script src="{{ asset('/js/notyf.min.js') }}"></script>
    <script type="application/javascript">
        var notyf = new Notyf({
            duration: 5000 // Set your global Notyf configuration here
        });
        $(document).ready(function() {
            $(".js-select2-multi").select2();
        });


        $(".select2").select2();

    </script>
    <script src="{{ asset('/js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
