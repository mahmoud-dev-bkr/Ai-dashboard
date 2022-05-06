<div class="flex flex-col h-auto py-4 overflow-auto border-0 md:h-screen bg-primary md:w-1/4">
    <div class="flex items-center mx-auto my-4 text-2xl font-bold">
        <span class="flex items-center justify-center w-10 h-10 p-2 mr-2 bg-white rounded-2xl text-secondary">AI</span>
        <h1 class="text-white">Attend</h1>
    </div>

    <div class="flex flex-col my-5 text-lg font-bold">

        @if (Auth::user() && Auth::user()->hasRole('super_admin'))
            <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-blue-500/50 
        {{ Request::path() == '/admin/users' ? 'dashboard-item-active' : '' }}" href="/admin/users">
                Users</a>
        @endif

        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-blue-500/50 
            {{ Request::path() == '/admin' ? 'dashboard-item-active' : '' }}" href="/admin">
            Home</a>

        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-blue-500/50 
            {{ Request::path() == '/admin' ? 'dashboard-item-active' : '' }}" href="/admin">
            Home</a>

        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-blue-500/50 
            {{ Request::path() == '/admin' ? 'dashboard-item-active' : '' }}" href="/admin">
            Home</a>



    </div>



</div>
