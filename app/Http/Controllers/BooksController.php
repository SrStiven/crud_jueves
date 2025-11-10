<?php

namespace App\Http\Controllers;


use App\Exports\BooksExport;
use App\Http\Requests\BooksRequest;
use App\Imports\BooksImport;
use App\Mail\InfoNotificationMail;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BooksController extends Controller
{
        public function index()
    {
        $books = Books::where('user_id', auth()->id())->get();
        return view('book.index', compact('books'));
    }

    public function create(BooksRequest $request)
    {
        $fillpath = $request->file('file')->store('books', 'public');

        $data = $request->validated();
        $data['file_path'] = $fillpath;
        $data['user_id'] = auth()->id();

        Books::create($data);

        return redirect()->route('book.index');
    }


    public function update(BooksRequest $request)
    {
        $book = Books::findOrFail($request -> id);

        if($request->hasFile('file')){
            if($book->file_path && Storage::disk('public')->exists($book->file_path))
            {
                Storage::disk('public')->delete($book->file_path);
            }

            $book->file_path = $request->file('file')->store('books','public');
        }

        $book->update([
            ...$request->validated(),
            'file_path'=>$book->file_path,
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
        Books::query()->delete();
        return back();
    }

    public function exportExcel(){

        return Excel::download(new BooksExport, 'jueves.xlsx');
    }

    public function importExcel(Request $request)
    {
        $request -> validate(['file' => 'required|mimes:xlsx,xls']);

        Excel::import(new BooksImport, $request->file('file'));

        $mensaje = "ya te llego el correo chamo";

        Mail::to('estivenmendezlara2020@gmail.com')->send(new InfoNotificationMail($mensaje));

        return redirect()->route('book.index');
    }
    
    public function logs($id)

    {

    $book = Books::with('logs.event')->findOrFail($id);

    $logs = $book->logs()->with('event')->orderBy('created_at', 'desc')->get();


    return view('book.logs', compact('book', 'logs'));
    }
}
