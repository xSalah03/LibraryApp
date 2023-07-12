@extends('layouts.layout')

@section('content')
    <div class="py-5">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action='{{ route('book.update', $book->id) }}' method='POST' enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Book title
                            </label>
                            <input type="text" id="title" name="title" value='{{ old('title') ?? $book->title }}'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @error('title') is-invalid @enderror">
                            @error('title')
                                <span class='text-red-700'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Author
                            </label>
                            <input type="text" id="author" name="author" value='{{ old('author') ?? $book->author }}'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @error('author') is-invalid @enderror">
                            @error('author')
                                <span class='text-red-700'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="published_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Published date
                            </label>
                            <input
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                            @error('published_date') is-invalid @enderror"
                                type="datetime-local" id="published_date" name="published_date"
                                value='{{ old('published_date') ? date('Y-m-d\TH:i', strtotime(old('published_date'))) : date('Y-m-d\TH:i', strtotime($book->published_date)) }}'>
                            @error('published_date')
                                <span class='text-red-700'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Description
                            </label>
                            <input type="text" id="description" name="description"
                                value='{{ old('description') ?? $book->description }}'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @error('description') is-invalid @enderror">
                            @error('description')
                                <span class='text-red-700'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Upload cover
                            </label>
                            <input id="cover_image" type="file" name="cover_image" value='{{ old('cover_image') ?? $book->cover_image }}'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('cover_image') is-invalid @enderror">
                            @error('cover_image')
                                <span class='text-red-700'>{{ $message }}</span>
                            @enderror
                        </div> <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
