@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Encabezado con botones de usuario --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                <i class="fas fa-book"></i> Gestión de Libros
            </h2>
            @auth
                <p class="text-muted mb-0">
                    <i class="fas fa-user-circle"></i> Usuario actual: 
                    <strong>{{ Auth::user()->name }}</strong>
                </p>
            @endauth
        </div>

        <div>
            {{-- Botón actualizar contraseña --}}
            <a href="{{ route('password.update.form') }}" class="btn btn-warning me-2">
                <i class="fas fa-key"></i> Actualizar Contraseña
            </a>

            {{-- Botón cerrar sesión --}}
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    {{-- Formulario crear libro --}}
    <div class="card shadow-lg mb-5">
        <div class="card-header bg-primary text-white text-center py-4">
            <h3 class="mb-0"><i class="fas fa-plus-circle"></i> Crear Nuevo Libro</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('book.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-user"></i> Nombre del Autor</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               placeholder="Ingrese el nombre del autor" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-book-open"></i> Título del Libro</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="form-control form-control-lg @error('title') is-invalid @enderror"
                               placeholder="Ingrese el título del libro" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-hashtag"></i> Cantidad</label>
                        <input type="number" name="count" value="{{ old('count') }}"
                               class="form-control form-control-lg @error('count') is-invalid @enderror"
                               placeholder="0" min="1" required>
                        @error('count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-calendar-alt"></i> Fecha de Vencimiento</label>
                        <input type="date" name="due_date" value="{{ old('due_date') }}"
                               class="form-control form-control-lg @error('due_date') is-invalid @enderror" required>
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-theater-masks"></i> Género</label>
                        <select name="gender" class="form-select form-select-lg @error('gender') is-invalid @enderror" required>
                            <option value="">Seleccionar género</option>
                            <option value="accion" {{ old('gender') == 'accion' ? 'selected' : '' }}>Acción</option>
                            <option value="comedia" {{ old('gender') == 'comedia' ? 'selected' : '' }}>Comedia</option>
                            <option value="ficcion" {{ old('gender') == 'ficcion' ? 'selected' : '' }}>Ficción</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold"><i class="fas fa-file-upload"></i> Archivo PDF o Word</label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.xlsx"
                           class="form-control form-control-lg @error('file') is-invalid @enderror" required>
                    <small class="text-muted">Formatos aceptados: PDF, DOC, DOCX, XLSX</small>
                    @error('file')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-save"></i> Guardar Libro
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Acciones globales --}}
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger"><i class="fas fa-trash-alt"></i> Eliminar Todos</h5>
                    <p class="text-muted">Eliminar todos tus libros</p>
                    <form action="{{ route('book.destroy') }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar todos tus libros?')">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-exclamation-triangle"></i> Eliminar Todo
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-success"><i class="fas fa-file-excel"></i> Exportar</h5>
                    <p class="text-muted">Descargar tus libros en Excel</p>
                    <a href="{{ route('book.export') }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Exportar Excel
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-info"><i class="fas fa-file-import"></i> Importar</h5>
                    <p class="text-muted">Cargar libros desde un archivo Excel</p>
                    <form action="{{ route('book.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <input type="file" name="file" class="form-control form-control-sm" required>
                        </div>
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-upload"></i> Cargar Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de libros --}}
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0"><i class="fas fa-list"></i> Mis Libros</h3>
        </div>
        <div class="card-body p-0">
            @if($books->isEmpty())
                <div class="p-4 text-center text-muted">No tienes libros registrados aún.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th><i class="fas fa-user"></i> Autor</th>
                                <th><i class="fas fa-book"></i> Título</th>
                                <th><i class="fas fa-hashtag"></i> Cantidad</th>
                                <th><i class="fas fa-theater-masks"></i> Género</th>
                                <th><i class="fas fa-calendar"></i> Fecha</th>
                                <th><i class="fas fa-file"></i> Archivo</th>
                                <th><i class="fas fa-history"></i> Logs</th>
                                <th colspan="2" class="text-center"><i class="fas fa-cog"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td><span class="badge bg-primary">{{ $book->count }}</span></td>
                                    <td><span class="badge bg-info">{{ ucfirst($book->gender) }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($book->due_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($book->file_path)
                                            <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                        @else
                                            <span class="text-muted">Sin archivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('book.logs', $book->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-history"></i> Logs
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('book.delete', $book->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este libro?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
