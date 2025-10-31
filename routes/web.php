    <?php

    use App\Http\Controllers\BooksController;
    use Illuminate\Support\Facades\Route;

    Route::get('/',[BooksController::class,'index'])->name('book.index');

    Route::post('/guardar',[BooksController::class,'create'])->name('book.create');

    Route::put('/actualizar/{id}',[BooksController::class,'update'])->name('book.update');

    Route::get('/editar/{book}',[BooksController::class,'edit'])->name('book.edit');

    Route::get('/eliminar/{book}',[BooksController::class,'delete'])->name('book.delete');

    //ELiminar todos los libros

    Route::post('/destroyAll',[BooksController::class,'destroy'])->name('book.destroy');

    //Export y Import

    Route::get('/libros/export',[BooksController::class,'exportExcel'])->name('book.export');

    Route::post('/libros/import',[BooksController::class,'importExcel'])->name('book.import');

    //Metodo mostrar logs

    Route::get('/logs/{id}', [BooksController::class, 'logs'])->name('book.logs');
