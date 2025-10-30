@extends('layouts.app')
@section('content')
<div class="container p-3 my-3 border">
    <div class="mx-auto" style="width:200px">
        <h2>Crear libros</h2>
    </div>
    <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" hidden="id" name="id" value="{{ $book->id }}">
        <div class="form-group">
            <label> Nombre del autor</label>
            <input type="text" name="name" required value="{{ $book->name }}">
        </div>
        <br>
        <div class="form-group">
            <label>Titulo del libro</label>
            <input type="text" name="title" required value="{{ $book->title }}">
        </div>
        <br>
        <div class="form-group">
            <label>Cantidad de libros</label>
            <input type="number" name="count" required min="0" value="{{ $book->count }}">
        </div>
        <br>
        <div class="form-group">
            <label>Fecha de vencimiento del libro</label>
            <input type="date" name="due_date" required value="{{ $book->due_date }}">
        </div>
        <div class="form-group">
            <label>Archivo actual:</label>
            @if ($book->file_path)
                <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank">Ver archivo</a>
            @else
                <span>No hay archivo</span>
            @endif
            <label>Subir nuevo archivo (opcional):</label>
            <input type="file" name="file" accept=".pdf,.doc,.docx">
        </div>
        <div class="form-group">
            <label>Genero del libro</label>
            <select name="gender" class="form-control">
                <option value="">Seleccinar</option>
                <option value="accion" {{ $book->gender == 'accion' ? 'selected' : '' }}>Accion</option>
                <option value="comedia" {{ $book->gender == 'comedia' ? 'selected' : '' }}>Comedia</option>
                <option value="ficcion" {{ $book->gender == 'ficcion' ? 'selected' : '' }}>Ficcion</option>
            </select>
        </div>
        <a href="{{ route('book.index') }}" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
</div>
  
@endsection
   