<div class="flex items-center justify-between bg-white shadow-2xl drop-shadow-md ">
    <div class="flex items-center mx-3">
        <img class="object-cover w-10 h-10 mx-auto rounded-full ring ring-primary ring-offset-info ring-offset-4"
            src='/images/avatar.jpg' alt="profile picture" />
        <div class="flex flex-col p-5">
            <h1 class="font-bold text-gray-500 ">{{ Auth::user()->name_en }}</h1>
            {{-- <p class="text-sm text-gray-300">{{ Auth::user()->role->first()->display_name }}</p> --}}
        </div>

    <a href="/admin/alertscompany" class="btn btn-ghost"><i class="mx-2 fa fa-bell"></i> Send notifications</a>

    </div>

    <div class="dropdown dropdown-end">

        <label tabindex="0" class="m-1 btn btn-lg btn-ghost"><i class="fa fa-bars"></i></label>
        <ul tabindex="0" class="p-2 shadow dropdown-content menu bg-base-100 rounded-box w-52">
            <li><a href="{{ url('admin/profile') }}">Profile</a></li>
            <li>
                {!! Form::open(['route' => 'logout', 'method' => 'DELETE']) !!}
                {{ Form::submit('Log out', ['class' => 'w-full rounded-0 cursor-pointer text-left']) }}
                {!! Form::close() !!}
            </li>
        </ul>
    </div>

</div>
