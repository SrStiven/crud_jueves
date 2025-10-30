<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BooksController::class, 'index'])->name('book.index');

Route::post('/create', [BooksController::class, 'create'])->name('book.create');

Route::post('/update/{id}', [BooksController::class, 'update'])->name('book.update');

Route::get('/edit/{id}', [BooksController::class, 'edit'])->name('book.edit');

Route::get('/eliminar/{book}', [BooksController::class, 'delete'])->name('book.delete');

//Eliminar todos los libros

Route::post('/destroyAll', [BooksController::class, 'destroy'])->name('book.destroy');

//Export y Import

Route::get('/libros/export', [BooksController::class, 'exportExcel'])->name('book.export');

Route::post('/libros/import', [BooksController::class, 'importExcel'])->name('book.import');

