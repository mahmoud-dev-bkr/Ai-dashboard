@extends('dashboard-layouts.app-tailwind')

@section('content')

    <div class="p-7">

        <div class="my-4">
            <a href="{{ LaravelLocalization::localizeUrl(route('insertTermPage')) }}" class="rounded-lg btn btn-info">
                <i class="fa fa-plus"></i>
                <span class="mx-3 text-lg font-bold">write a new Term</span>
            </a>
        </div>
    </div>


    <div class="p-7">
        <h1 class="my-3 text-3xl font-bold text-priamry">Terms and conditions</h1>

        <div class="mt-5 terms">
            @foreach ($terms as $t)

                <div class="p-4 my-4 overflow-x-auto bg-white rounded-lg shadow-lg">
                    <h1 class="mb-3 text-2xl text-blue-500">{{ $t->title }}</h1>
                    <pre>{{ $t->body }}</pre>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')

@endsection
