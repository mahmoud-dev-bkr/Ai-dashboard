@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="p-7">
    <h1 class="my-3 text-3xl font-bold text-priamry">Headers Content</h1>

    <div class="mt-5 terms">
        @foreach ($headers as $head)
            <div class="p-4 my-4 overflow-x-auto bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <a href="{{url("admin/header/update/$head->id")}}"><i class="fa fa-pen"></i></a>
                </div>
                <h1 class="mb-3 text-2xl text-blue-500">{{$head->title}}</h1>
                <span>{{$head->content}}</span>
                <p style="white-space: pre-wrap;">{{$head->paragraph}}</p>
                <h1 class="mb-3 text-2xl text-blue-500">{{$head->title_ar}}</h1>
                <span>{{$head->content_ar}}</span>
                <p style="white-space: pre-wrap;">{{$head->paragraph_ar}}</p>
                <img class="w-32" src="{{url("uploads/$head->img")}}" alt="">
            </div>
            @endforeach
    </div>
</div>
@endsection