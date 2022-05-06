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
    <div class="mx-4">
        <div
            class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
        >
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Create a Gig
                </h2>
                <p class="mb-4">Post a gig to find a developer</p>
            </header>

            <form action="{{ route('gig.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label
                        for="company"
                        class="inline-block text-lg mb-2"
                        >Company Name</label
                    >
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="company"
                        value="{{ old('company') }}"
                    />
                    @error('company')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="title" class="inline-block text-lg mb-2"
                        >Job Title</label
                    >
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="title"
                        placeholder="Example: Senior Laravel Developer"
                        value="{{ old('title') }}"
                    />
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="location"
                        class="inline-block text-lg mb-2"
                        >Job Location</label
                    >
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="location"
                        placeholder="Example: Remote, Boston MA, etc"
                        value="{{ old('location') }}"
                    />
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2"
                        >Contact Email</label
                    >
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="email"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="website"
                        class="inline-block text-lg mb-2"
                    >
                        Website/Application URL
                    </label>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="website"
                        value="{{ old('website') }}"
                    />
                    @error('website')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="tags" class="inline-block text-lg mb-2">
                        Tags (Comma Separated)
                    </label>
                    <select class="js-example-basic-multiple border border-gray-200 rounded p-2 w-full" id="multiple_tags" name="tags[]" multiple="multiple">
                        @foreach (App\Models\Tag::all() as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>
                    {{-- <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="tags"
                        placeholder="Example: Laravel, Backend, Postgres, etc"
                    /> --}}
                </div>

                <div class="mb-6">
                    <label for="logo" class="inline-block text-lg mb-2">
                        Company Logo
                    </label>
                    <input
                        type="file"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="logo"
                    />
                    @error('logo')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="description"
                        class="inline-block text-lg mb-2"
                    >
                        Job Description
                    </label>
                    <textarea
                        class="border border-gray-200 rounded p-2 w-full"
                        name="description"
                        rows="10"
                        placeholder="Include tasks, requirements, salary, etc"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                    >
                        Create Gig
                    </button>

                    <a href="/" class="text-black ml-4"> Back </a>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection