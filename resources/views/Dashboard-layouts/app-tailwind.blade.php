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
            background: #7362d6;
        }

        .dataTables_empty {
            background-color: rgb(189, 61, 61);
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
            outline-color: #672dae !important;
            border-radius: 15px !important;

        }

        .table thead th:first-child {
            position: relative !important;
        }

        .table td {
            border: 1px solid rgb(204, 204, 204) !important;
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

    </style>
    <link rel="stylesheet" href="{{ asset('/css/notyf.min.css') }}">

    @yield('cdnStyle')
    @yield('styles')

</head>

<body>
    <div class="flex flex-col md:flex-row">
        @include('dashboard-layouts.inc.sidebar')
        <div class="w-full h-auto md:h-screen md:overflow-auto">
            {{-- navbar --}}
            @include('dashboard-layouts.inc.navbar')
            <div class="h-auto overflow-y-auto md:flex-1">
                <div class="h-full bg-white rounded-lg shadow-2xl p-7">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
    {{-- sweet alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{--select2 --}}
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

    </script>
    @yield('scripts')
</body>

</html>
