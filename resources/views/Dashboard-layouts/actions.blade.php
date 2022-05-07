@if ($type == 'roles')
    <ul class="w-56 menu">
        @foreach ($roles as $role)
            <li class="p-2 my-2 rounded-lg bg-base-200/25">{{ $role->name }}</li>
        @endforeach
    </ul>


@elseif($type == 'roles_users')
    <table class="table table-compact">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= $users->count(); $i++)
                <tr>
                    <th>{{ $i }}</th>
                    <th>{{ $users[$i - 1]->name_en }}</th>
                </tr>
            @endfor
        </tbody>
    </table>
@endif
