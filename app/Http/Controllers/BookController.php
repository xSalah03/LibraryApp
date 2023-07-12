<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'published_date' => 'required|date',
            'description' => 'required|min:5|max:255',
            'cover_image' => 'required|mimes:png,jpg,webp|max:4096',
        ]);
        $book = new Book();
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->published_date = $validatedData['published_date'];
        $book->description = $validatedData['description'];
        if ($request->hasFile('cover_image')) {
            $book->cover_image = $request->file('cover_image')->store('images/books');
        }
        $book->save();
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'published_date' => 'required|date',
            'description' => 'required|min:5|max:255',
            'cover_image' => 'required|mimes:png,jpg,webp|max:4096',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->published_date = $validatedData['published_date'];
        $book->description = $validatedData['description'];

        if ($request->hasFile('cover_image')) {
            // Delete previous cover_image image if it exists
            if ($book->cover_image) {
                Storage::delete($book->cover_image);
            }

            $book->cover_image = $request->file('cover_image')->store('images/posts');
        }

        $book->save();

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if ($book) {
            $book->delete();
            return redirect()->route('book.index');
        }
        return redirect()->back();
    }
}
