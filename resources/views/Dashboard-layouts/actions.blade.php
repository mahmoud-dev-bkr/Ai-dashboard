@if ($type == 'roles')
    <ul class="w-56 menu bg-base-100">
        @foreach ($roles as $role)
            <li class="p-2 my-2 rounded-lg bg-base-200/25">{{ $role->name }}</li>
        @endforeach
    </ul>
@endif
