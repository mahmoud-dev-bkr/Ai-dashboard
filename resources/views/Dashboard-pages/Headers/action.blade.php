@if ($type == 'header_img')
    <img class="object-cover w-40 h-40" src="{{ asset("uploads/$img") }}" alt="">
@endif
@if ($type == 'action')
    <a href="{{ url("admin/header/view/$id") }}" class=""><i class="fa fa-eye"></i></a>

@endif
