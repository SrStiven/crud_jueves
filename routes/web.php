    <?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\Report\ReportBookEditorialController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [BooksController::class, 'index'])->name('book.index');
    Route::post('/guardar', [BooksController::class, 'create'])->name('book.create');
    Route::put('/actualizar/{id}', [BooksController::class, 'update'])->name('book.update');
    Route::get('/editar/{book}', [BooksController::class, 'edit'])->name('book.edit');
    Route::get('/eliminar/{book}', [BooksController::class, 'delete'])->name('book.delete');
    Route::post('/destroyAll', [BooksController::class, 'destroy'])->name('book.destroy');
    Route::get('/libros/export', [BooksController::class, 'exportExcel'])->name('book.export');
    Route::post('/libros/import', [BooksController::class, 'importExcel'])->name('book.import');
    Route::get('/logs/{id}', [BooksController::class, 'logs'])->name('book.logs');
    Route::get('/update-password', [AuthController::class, 'showUpdatePasswordForm'])->name('password.update.form');
    Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

// Login y registro
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Actualizar contraseña

Route::get('/password/update', [AuthController::class, 'showUpdatePasswordForm'])->name('password.update.form')->middleware('auth');
Route::post('/password/update', [AuthController::class, 'updatePassword'])->name('password.update')->middleware('auth');

Route::prefix('report/editorial')->middleware('auth')->group(function () {
    Route::get('/', [ReportBookEditorialController::class, 'index'])->name('report.editorial.index');
    Route::get('/search', [ReportBookEditorialController::class, 'search'])->name('report.editorial.search');
    Route::get('/export', [ReportBookEditorialController::class, 'export'])->name('report.editorial.export');
});