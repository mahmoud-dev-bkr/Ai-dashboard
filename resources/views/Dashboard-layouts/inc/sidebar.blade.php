<div class="flex flex-col h-auto py-4 overflow-auto border-0 md:h-screen bg-primary md:w-1/4">
    <div class="flex items-center mx-auto my-4 text-2xl font-bold">
        <span class="flex items-center justify-center w-10 h-10 p-2 mr-2 bg-white rounded-2xl text-secondary">AI</span>
        <h1 class="text-white">Attend</h1>
    </div>

    <div class="flex flex-col my-5 space-y-4 text-lg font-bold sidebar-items">


        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin') ? 'dashboard-item-active bg-neutral/25' : '' }}
        " href=" /admin">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Home
        </a>


        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/company') ? 'dashboard-item-active bg-neutral/25' : '' }}
            " href=" /admin/company">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Companies</a>



        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/paymentdetails') ? 'dashboard-item-active bg-neutral/25' : '' }}
            " href=" /admin/paymentdetails">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Payment details</a>





        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/Plan/') ? 'dashboard-item-active bg-neutral/25' : '' }}
            " href="{{ url('admin/Plan/') }}">

            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Plans</a>



        @if (Auth::user() && Auth::user()->hasRole('super_admin'))
            <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/users') ? 'dashboard-item-active bg-neutral/25' : '' }}
            " href=" /admin/users">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Users</a>
        @endif

        {{-- @if (Auth::user() && Auth::user()->hasRole('super_admin')) --}}
        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/paymentsmethods/') ? 'dashboard-item-active bg-neutral/25' : '' }}
        " href="{{ url('admin/paymentsmethods/') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Payment Methods</a>
        {{-- @endif --}}


        {{-- @if (Auth::user() && Auth::user()->hasRole('super_admin')) --}}
        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/alerts') ? 'dashboard-item-active bg-neutral/25' : '' }}
        " href="{{ url('admin/alerts') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            Alert Messages</a>
        {{-- @endif --}}

        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/alertscompany') ? 'dashboard-item-active bg-neutral/25' : '' }}
        " href="{{ url('admin/alertscompany') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            Send Notification</a>
            









        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/roles') ? 'dashboard-item-active bg-neutral/25' : '' }}
        " href=" /admin/roles">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 mx-2" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
            </svg>
            Roles</a>

        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/header') ? 'dashboard-item-active bg-neutral/25' : '' }}
        " href=" /admin/header">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 mx-2" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M448 448c0 17.69-14.33 32-32 32h-96c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-144h-224v144H128c17.67 0 32 14.31 32 32s-14.33 32-32 32H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-320H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32H112v112h224v-112H320c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32h-16v320H416C433.7 416 448 430.3 448 448z"/>
        </svg>Header</a>


        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/terms') ? 'dashboard-item-active bg-neutral/25' : '' }}
            " href=" /admin/terms">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
            </svg>
            Terms and Conditions</a>

    </div>



</div>
