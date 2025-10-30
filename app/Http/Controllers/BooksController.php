<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksRequest;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::all();

        return view('book.index', compact('books'));
    }

    public function create(BooksRequest $request)
    {
        $fillpath = $request->file('file')->store('books', 'public');

        $data = $request->validated();
        $data['file_path'] = $fillpath;

        Books::create($data);

        return back();
    }

    public function update(BooksRequest $request)
    {
        $book = Books::findOrFail($request -> id);

        if($request->hasFile('file')){
            if($book->file_path && Storage::disk('public')->exists($book->file_path)){
                Storage::disk('public')->delete($book->file_path);
            }
            $book->file_path = $request->file('file')->store('books', 'public');
        }

        $book->update([
            ...$request->validated(),
            'file_path' => $book->file_path,
        ]);

        return redirect()->route('book.index');
    }

    public function edit(Books $book)
    {

        return view('book.edit', compact('book'));

    }

    public function delete(Books $book)
    {
        $book -> delete();

        return redirect()->route('book.index');
    }

    public function destroy()
    {
        Books::truncate();
        return back();
    }

    
    
}
