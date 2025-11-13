<?php

namespace App\Http\Controllers\Report;

use App\Exports\BooksExport;
use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Editorial;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportBookEditorialController extends Controller
{
    public function index()
    {
        //Retornar todos los libros agrupados por editorial
        $editorials = \App\Models\Editorial::with('books')->get();

            $books = collect();

    return view('report.editorial.index', compact('editorials', 'books'));
    }

    public function search(Request $request)
    {
        //Retornar todos los libros agrupados por editorial con los filtros definidos por el usuario
        $query = \App\Models\Books::with('editorial');

        // Filtrar por editorial
        if ($request->filled('editorial_id')) {
            $query->where('editorial_id', $request->editorial_id);
        }

        // Filtrar por género
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filtrar por rango de fechas
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('due_date', [$request->date_from, $request->date_to]);
        }

        // Ejecutar consulta
        $books = $query->get();

        // Obtener editoriales para el combo de búsqueda
        $editorials = \App\Models\Editorial::all();

        // Retornar solo los libros filtrados
        return view('report.editorial.index', compact('books', 'editorials'));
    }

    public function export(Request $request)
    {
        //Generar un archivo de excel con los datos, tambien el export recibe filtros
        return Excel::download(new BooksExport($request->all()), 'reporte_editoriales.xlsx');
    }
}
