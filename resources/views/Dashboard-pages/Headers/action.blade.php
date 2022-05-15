@if ($type == "header_img")
    <img src="{{url("uploads/$img")}}" alt="">
@endif
@if ($type == 'action')
    <a href="{{url("admin/header/view/$id")}}" class=""><i class="fa fa-eye"></i></a>

@endif