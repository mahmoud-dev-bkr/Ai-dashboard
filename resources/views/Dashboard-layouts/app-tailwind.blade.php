<!DOCTYPE html>
<html lang={{ LaravelLocalization::getCurrentLocale() }}
    dir={{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : 'ltr' }} data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/app.css" />
    <style>
        .dashboard-item-active {
            border-right: 6px solid white;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

    </style>
    @yield('cdnStyle')
    @yield('styles')

</head>

<body>
    <div class="flex flex-col md:flex-row">
        @include('dashboard-layouts.inc.sidebar')
        <div class="w-full h-auto md:h-screen md:overflow-auto">
            {{-- navbar --}}
            @include('dashboard-layouts.inc.navbar')
            @yield('content')
        </div>
    </div>


    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- data tables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{-- font awesome --}}
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

    @yield('scripts')
</body>

</html>
