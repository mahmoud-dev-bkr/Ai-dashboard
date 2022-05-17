@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="p-7">

    <div class="my-4">
        <a href="{{ LaravelLocalization::localizeUrl(route('createFaq')) }}" class="rounded-lg btn btn-info">
            <i class="fa fa-plus"></i>
            <span class="mx-3 text-lg font-bold">write a new FAQ</span>
        </a>
    </div>
</div>

<div class="p-7">
    <h1 class="my-3 text-3xl font-bold text-priamry">FAQ</h1>

    <div class="mt-5 terms">
        @foreach ($faq as $t)

            <div class="p-4 my-4 overflow-x-auto bg-white rounded-lg shadow-lg">
                <div>
                    <div class="flex items-center justify-between">
                        <a href="{{url("admin/faq/update/$t->id")}}"><i class="fa fa-pen"></i></a>
                    </div>
                    <div class="flex items-center justify-between">
                        <a href="{{url("admin/faq/delete/$t->id")}}"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
                <h1 class="mb-3 text-2xl text-blue-500">{{ $t->title }}</h1>
                <p style="white-space: pre-wrap;">{{ $t->paragraph }}</p>

                <h1 class="mb-3 text-2xl text-blue-500">{{ $t->title_ar }}</h1>
                <p style="white-space: pre-wrap;">{{ $t->paragraph_ar }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
