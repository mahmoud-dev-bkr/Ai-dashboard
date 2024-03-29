@extends('Dashboard-layouts.app-tailwind')
@section('content')
<div class="p-7">
    <h1 class="my-3 text-3xl font-bold text-priamry">Terms and conditions</h1>

    <div class="mt-5 terms">
        @foreach ($header as $t)

            <div class="p-4 my-4 overflow-x-auto bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <a href="{{ route('update_header', ['id' => $t->id]) }}"><i class="fa fa-pen"></i></a>
                    {{-- <a href="{{ route('') }}"><i class="fa fa-pen"></i></a> --}}
                </div>
                <div class="mb-3">
                    <h1 class="text-2xl text-blue-500">{{ $t->title }}</h1>
                    <h3 class="text-2xl ">{{ $t->content }}</h3>
                    <p style="white-space: pre-wrap;">{{ $t->paragraph }}</p>
                </div>
                <div class="mb-3">
                    <h1 class="text-2xl text-blue-500">{{ $t->title_ar }}</h1>
                    <h3 class="text-2xl ">{{ $t->content_ar }}</h3>
                    <p style="white-space: pre-wrap;">{{ $t->paragraph_ar }}</p>
                </div>

                <div class="flex items-center text-center">
                    <img class="w-32 p-2" src="{{asset("uploads/$t->img")}}"  alt="">
                    <img class="w-32 p-2" src="{{asset("uploads/$t->image_2")}}" alt="">    
                </div>
            </div>
        @endforeach
    </div>

    <h1 class="my-4 text-3xl font-bold">Sentences</h1>
   <a href="/admin/sentance" class="link">Sentences page</a>
    <div class="my-5 bg-white">
        @foreach ($sentences as $sentence)
            <div class="p-5 my-4 text-2xl rounded-md bg-gray-50">{{$sentence->sentence_en}}</div>
        @endforeach
    </div>


</div>
@endsection
@section('scripts')
<script>

</script>
@endsection