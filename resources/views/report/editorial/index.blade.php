@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-primary mb-4">
        <i class="fas fa-building"></i> Reporte por Editorial
    </h2>

    {{-- 🔍 Filtros --}}
    <form action="{{ route('report.editorial.search') }}" method="GET" class="card shadow p-4 mb-5">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="fw-bold">Editorial</label>
                <select name="editorial_id" class="form-select">
                    <option value="">Todas</option>
                    @foreach($editorials as $editorial)
                        <option value="{{ $editorial->id }}" 
                            {{ request('editorial_id') == $editorial->id ? 'selected' : '' }}>
                            {{ $editorial->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="fw-bold">Género</label>
                <select name="gender" class="form-select">
                    <option value="">Todos</option>
                    <option value="accion" {{ request('gender') == 'accion' ? 'selected' : '' }}>Acción</option>
                    <option value="comedia" {{ request('gender') == 'comedia' ? 'selected' : '' }}>Comedia</option>
                    <option value="ficcion" {{ request('gender') == 'ficcion' ? 'selected' : '' }}>Ficción</option>
                </select>
            </div>

            <div class="col-md-5 mb-3">
                <label class="fw-bold">Rango de fechas</label>
                <div class="d-flex gap-2">
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                </div>
            </div>
        </div>

        <div class="text-end">
            <button class="btn btn-primary">
                <i class="fas fa-search"></i> Buscar
            </button>
            <a href="{{ route('book.index') }}" class="btn btn-gray">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
            <a href="{{ route('report.editorial.export') }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Exportar Excel
            </a>
        </div>
    </form>

    {{-- 📊 Resultados --}}
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><i class="fas fa-book"></i> Resultados de la búsqueda</h5>
        </div>

        <div class="card-body p-0">
            @if ($books->isEmpty())
                <p class="text-muted text-center p-4 mb-0">
                    No se encontraron resultados para los filtros aplicados.
                </p>
            @else
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Autor</th>
                            <th>Título</th>
                            <th>Género</th>
                            <th>Editorial</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ ucfirst($book->gender) }}</td>
                                <td>{{ $book->editorial?->name ?? 'Sin editorial' }}</td>
                                <td>{{ \Carbon\Carbon::parse($book->due_date)->format('d/m/Y') }}</td>
                                <td>{{ $book->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
