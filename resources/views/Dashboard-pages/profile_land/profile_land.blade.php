@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="p-7">
    <h1 class="my-3 text-3xl font-bold text-priamry">Profile</h1>

    <div class="mt-5 terms">
        @foreach ($profile as $p)

            <div class="p-4 my-4 overflow-x-auto bg-white rounded-lg shadow-lg">
                <div class="my-4">
                    <a href="{{ LaravelLocalization::localizeUrl(route('createFaq')) }}" class="rounded-lg btn btn-info">
                        <i class="fa fa-plus"></i>
                        <span class="mx-3 text-lg font-bold">write a new FAQ</span>
                    </a>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('update_land_page', ['id' => $p->id]) }}"><i class="fa fa-pen"></i></a>
                    {{-- <a href="{{ route('') }}"><i class="fa fa-pen"></i></a> --}}
                </div>
                <div class="mb-3">
                    <h1 class="text-2xl text-blue-500">{{ $p->span }}</h1>
                    <h3 class="text-2xl ">{{ $p->title }}</h3>
                </div>
                <div class="mb-3">
                    <h1 class="text-2xl text-blue-500">{{ $p->span_ar }}</h1>
                    <h3 class="text-2xl ">{{ $p->title_ar }}</h3>
                </div>

                <div class="flex items-center text-center">
                    <img class="p-2 w-32" src="{{asset("uploads/$p->img")}}"  alt="">
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
@endsection