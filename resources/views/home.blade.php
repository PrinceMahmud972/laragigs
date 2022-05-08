@extends('layouts.app')

@section('main')

@if (session('success'))
    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
        <p>{{ session('success') }}</p>
    </div>
@endif

@include('layouts.hero')

<main>
    @include('layouts.search')

    <div
        class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
    >
        <!-- Item 1 -->
        @foreach ($gigs as $gig)
        <div class="bg-gray-50 border border-gray-200 rounded p-6">
            <div class="flex">
                <img
                    class="hidden w-48 mr-6 md:block"
                    src="/images/{{ $gig->logo }}"
                    alt=""
                />
                <div>
                    <h3 class="text-2xl">
                        <a href="{{ route('gig.show', ['id' => $gig->id]) }}">{{ $gig->job_title }}</a>
                    </h3>
                    <div class="text-xl font-bold mb-4">{{ $gig->company_name }}</div>
                    <ul class="flex">
                        @foreach ($gig->tags as $tag)
                        <li
                            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                        >
                            <a href="/tag/{{ $tag->id }}">{{ $tag->tag_name }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="text-lg mt-4">
                        <i class="fa-solid fa-location-dot"></i> {{ $gig->job_location }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach



    </div>
</main>

@endsection