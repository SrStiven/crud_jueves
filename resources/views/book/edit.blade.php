@extends('layouts.app')
@section('content')

<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark text-center py-4">
            <h2 class="mb-0"><i class="fas fa-edit"></i> Editar Libro</h2>
            <p class="mb-0 mt-2 text-muted">Actualiza la información del libro</p>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $book->id }}">

            
                <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-info-circle me-3 fs-4"></i>
                    <div>
                        <strong>Editando el libro:</strong> {{ $book->title }} 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-user text-primary"></i> Nombre del Autor
                        </label>
                        <input type="text" name="name" 
                               class="form-control form-control-lg @error('name') is-invalid @enderror" 
                               value="{{ old('name', $book->name) }}"
                               placeholder="Ingrese el nombre del autor" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-book-open text-primary"></i> Título del Libro
                        </label>
                        <input type="text" name="title" 
                               class="form-control form-control-lg @error('title') is-invalid @enderror" 
                               value="{{ old('title', $book->title) }}"
                               placeholder="Ingrese el título del libro" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-hashtag text-primary"></i> Cantidad
                        </label>
                        <input type="number" name="count" 
                               class="form-control form-control-lg @error('count') is-invalid @enderror" 
                               value="{{ old('count', $book->count) }}"
                               min="0" placeholder="0" required>
                        @error('count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-alt text-primary"></i> Fecha de Vencimiento
                        </label>
                        <input type="date" name="due_date" 
                               class="form-control form-control-lg @error('due_date') is-invalid @enderror" 
                               value="{{ old('due_date', $book->due_date) }}" required>
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-theater-masks text-primary"></i> Género
                        </label>
                        <select name="gender" class="form-select form-select-lg @error('gender') is-invalid @enderror" required>
                            <option value="">Seleccionar género</option>
                            <option value="accion" {{ old('gender', $book->gender) == 'accion' ? 'selected' : '' }}>Acción</option>
                            <option value="comedia" {{ old('gender', $book->gender) == 'comedia' ? 'selected' : '' }}>Comedia</option>
                            <option value="ficcion" {{ old('gender', $book->gender) == 'ficcion' ? 'selected' : '' }}>Ficción</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

              
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-file-pdf text-danger"></i> Gestión de Archivo
                        </h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Archivo Actual:</label>
                            <div class="d-flex align-items-center">
                                @if ($book->file_path)
                                    <div class="alert alert-success mb-0 me-3">
                                        <i class="fas fa-check-circle"></i> 
                                        Archivo disponible
                                    </div>
                                    <a href="{{ asset('storage/' . $book->file_path) }}" 
                                       target="_blank" 
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i> Ver Archivo
                                    </a>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-exclamation-triangle"></i> 
                                        No hay archivo cargado
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-bold">
                                <i class="fas fa-file-upload text-primary"></i> 
                                Subir Nuevo Archivo <span class="text-muted">(opcional)</span>
                            </label>
                            <input type="file" name="file" 
                                   accept=".pdf,.doc,.docx,.xlsx" 
                                   class="form-control form-control-lg @error('file') is-invalid @enderror">
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-info-circle"></i> 
                                Si seleccionas un archivo, reemplazará el actual. Formatos: PDF, DOC, DOCX, XLSX
                            </small>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <a href="{{ route('book.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Información Adicional -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-clock text-info"></i> Información del Registro
                    </h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <strong>ID:</strong> 
                            <span class="badge bg-secondary">{{ $book->id }}</span>
                        </li>
                        @if($book->created_at)
                        <li class="mb-2">
                            <strong>Creado:</strong> 
                            {{ \Carbon\Carbon::parse($book->created_at)->format('d/m/Y H:i') }}
                        </li>
                        @endif
                        @if($book->updated_at)
                        <li>
                            <strong>Última actualización:</strong> 
                            {{ \Carbon\Carbon::parse($book->updated_at)->format('d/m/Y H:i') }}
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-question-circle text-warning"></i> Ayuda
                    </h5>
                    <ul class="mb-0">
                        <li>Todos los campos marcados son obligatorios</li>
                        <li>El archivo solo se actualizará si seleccionas uno nuevo</li>
                        <li>Los cambios se guardarán al hacer clic en "Guardar Cambios"</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>