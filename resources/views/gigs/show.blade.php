@extends('layouts.app')

@section('main')

<main>
    @include('layouts.search')
    <a href="{{ route('home') }}" class="inline-block text-black ml-4 mb-4"
        ><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <div
                class="flex flex-col items-center justify-center text-center"
            >
                <img
                    class="w-48 mr-6 mb-6"
                    src="/images/{{ $gig->logo }}"
                    alt=""
                />

                <h3 class="text-2xl mb-2">{{ $gig->job_title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $gig->company_name }}</div>
                <ul class="flex">
                    @foreach ($gig->tags as $tag)
                    <li
                        class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                    >
                        <a href="/tag/{{ $tag->id }}">{{ $tag->tag_name }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $gig->job_location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>
                            {{ $gig->job_description }}
                        </p>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur
                            adipisicing elit. Quaerat praesentium eos
                            consequuntur ex voluptatum necessitatibus
                            odio quos cupiditate iste similique rem in,
                            voluptates quod maxime animi veritatis illum
                            quo sapiente.
                        </p>

                        <a
                            href="mailto:{{ $gig->contact_email }}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                            ><i class="fa-solid fa-envelope"></i>
                            {{ $gig->contact_email }}</a
                        >

                        <a
                            href="https://{{ $gig->url }}"
                            target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                            ><i class="fa-solid fa-globe"></i> {{ $gig->url }} </a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection