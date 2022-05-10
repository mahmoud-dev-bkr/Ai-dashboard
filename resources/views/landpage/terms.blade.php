@extends('landpage.layout')

@section('cdnStyle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection


@section('styles')

@endsection

@section('content')
    <div class="p-10 m-2 mt-20 text-3xl leading-loose text-gray-500 bg-white rounded-xl md:mx-10">
        <h1 class="text-3xl font-bold mb-7">Terms and Conditions</h1>

        @foreach ($terms as $term)
            <h2 class="text-2xl font-bold text-primary">{{ $term->title }}</h2>
            <p style="white-space: pre-wrap;">{{ $term->body }}</p>
        @endforeach

    </div>
@endsection

@section('scripts')

@endsection
