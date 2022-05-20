<div class="flex flex-col h-auto py-4 overflow-auto border-0 opacity-0 bg-primary md:h-screen drop-shadow-md md:w-1/5"
    id="sidebar">
    <div class="flex items-center mx-auto my-4 text-2xl font-bold">
       <img src="/images/logo.png" class="w-10 h-10"/>
        <h1 class="font-bold text-white">Ai Attend</h1>
    </div>
    <div>


        <nav class="">
            
            @if(Auth::user()->hasPermission('manage_landpage'))
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-6 py-3 text-gray-200 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                    <span class="flex items-center">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>

                        <span class="mx-4 font-medium text-left">Landpage</span>
                    </span>

                    <span>
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                            <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </button>

                <div x-show="open" class="bg-violet-900">
                    <a class="block px-16 py-2 text-sm text-left text-gray-200 hover:bg-violet-900 hover:text-white"
                        href=" /admin/header">
                        Header</a>
                    <a class="block px-16 py-2 text-sm text-gray-200 hover:bg-violet-900 hover:text-white"
                        href="/admin/sentance">sentances</a>

                    <a class="block px-16 py-2 text-sm text-gray-200 hover:bg-violet-900 hover:text-white"
                    href="/admin/profile_land">Profile</a>

                    <a class="block px-16 py-2 text-sm text-gray-200 hover:bg-violet-900 hover:text-white"
                    href="/admin/features_land">profile sections</a>

                    <a class="block px-16 py-2 text-sm text-gray-200 hover:bg-violet-900 hover:text-white"
                    href="/admin/faq">FAQ</a>

                    <a class="block px-16 py-2 text-sm text-gray-200 hover:bg-violet-900 hover:text-white"
                    href="/admin/reviews">reviews</a>
                  
                    <a class="block px-16 py-2 text-sm text-gray-200 hover:bg-violet-900 hover:text-white"
                    href="/admin/terms">Terms and conditions</a>
                </div>
            </div>
            @endif
            {{-- users and roles --}}

            <div x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-6 py-3 text-gray-200 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 " viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                      </svg>

                    <span class="mx-4 font-medium text-left">Users and roles</span>
                </span>

                <span>
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                        <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </button>

            <div x-show="open" class="bg-violet-900">
                <a class="block px-16 py-2 text-sm text-left text-gray-200 hover:bg-violet-900 hover:text-white"
                    href=" /admin/users">
                    Users</a>
                <a class="block px-16 py-2 text-sm text-gray-200 hover:bg-violet-900 hover:text-white"
                    href="/admin/roles">Roles</a>
            </div>
        </div>



        </nav>

    </div>

    <a class="w-full py-4 mx-3 font-bold text-left text-gray-100 duration-300 ease-in-out hover:bg-neutral/25 " href=" /admin/company">
    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
    </svg>
    Companies</a>




    <a class="w-full py-4 mx-3 font-bold text-left text-gray-100 duration-300 ease-in-out hover:bg-neutral/25 " href="{{ url('admin/Plan/') }}">

    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
    </svg>
    Plans</a>

    <a class="w-full py-4 mx-3 font-bold text-left text-gray-100 duration-300 ease-in-out hover:bg-neutral/25 " href=" /admin/paymentdetails">
    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    Payment details</a>


    <a class="w-full py-4 mx-3 font-bold text-left text-gray-100 duration-300 ease-in-out hover:bg-neutral/25 " href="{{ url('admin/paymentsmethods/') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        Payment Methods</a>

        
<a class="w-full py-4 mx-3 font-bold text-left text-gray-100 duration-300 ease-in-out hover:bg-neutral/25 " href="{{ url('admin/alerts') }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>
    Alert Messages</a>

<a class="w-full py-4 mx-3 font-bold text-left text-gray-100 duration-300 ease-in-out hover:bg-neutral/25 " href="{{ url('admin/alertscompany') }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>
    Send Notification</a>

</div>
