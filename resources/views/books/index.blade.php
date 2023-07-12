@extends('layouts.layout')
@section('content')
    <div class="">
        <a class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900"
            href="{{ route('book.create') }}" class="text-white">Add book</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Book title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Published date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cover
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $book->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $book->author }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $book->published_date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::limit($book->description, 15) }}
                        </td>
                        <td class="px-6 py-4">
                            <img class="w-10 h-10 rounded-full shadow-lg object-cover" src="{{ asset($book->cover_image) }}"
                                alt="Bonnie image" />
                        </td>
                        <td class="px-6 py-4 text-left">
                            <a href="{{ route('book.edit', $book->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <i class="fa-solid fa-pen-to-square mx-1"></i>Edit
                            </a>
                            <button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion-{{ $book->id }}')"
                                href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                <i class="fa-solid fa-trash mx-1"></i>Delete
                            </button>
                            <x-modal name="confirm-book-deletion-{{ $book->id }}" :show="$errors->bookDeletion->isNotEmpty()" maxWidth="2xl">
                                <form method="POST" action="{{ route('book.destroy', $book->id) }}" class="p-6">
                                    @csrf
                                    @method('delete')
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete this book?') }}
                                    </h2>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button
                                            x-on:click="$dispatch('close', 'confirm-book-deletion-{{ $book->id }}')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>
                                        <x-danger-button class="ml-3">
                                            {{ __('Delete Book') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        </td>
                    </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
