@extends('layouts.app')
@section('content')

    <div class="container p-3 my-3 border">
        <div class="mx-auto" style="width:200px">
            <h2>Crear libros</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
             @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
             @endforeach
            </ul>
            </div>
        @endif
        <form action="{{ route('book.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label> Nombre del autor</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label>Titulo del libro</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label>Cantidad de libros</label>
            <input type="text" name="count" value="{{ old('count') }}" required >
        </div>
        <div class="form-group">
            <label>Fecha de vencimiento del libro</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" required>
        </div>
        <div class="form-group">
            <label>Genero del libro</label>
            <select name="gender" class="form-control">
                <option value="">Seleccinar</option>
                <option value="accion" {{ old('gender') == 'accion' ? 'selected' : '' }}>Accion</option>
                <option value="comedia"{{ old('gender') == 'comedia' ? 'selected' : '' }}>Comedia</option>
                <option value="ficcion" {{ old('gender') == 'ficcion' ? 'selected' : '' }}>Ficcion</option>
            </select>
        </div>
         <div class="form-group">
            <label>Archivo PDF o Word</label>
            <input type="file" name="file" accept=".pdf,.doc,.docx" class="form-control" required>
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <button type="submit">Enviar</button>
    </form>
    </div>
 
    <hr>
    <form action="{{ route('book.destroy') }}" method="POST" onsubmit="return confirm('Estas seguro?')">
        @csrf
        <div>
            <label>Eliminar todos los libros</label>
            <button type="submit" class="btn btn-danger"> Eliminar</button>
        </div>
    </form>
    <hr>
    <div class="container">
        <div class="container p-3 my-3 border">
            <h2>Export</h2>
            <label>Export excel</label>
            <a href="{{ route('book.export') }}"  class="btn btn-light">Exportar excel</a>
    </div>

    <div class="container p-3 my-3 border">
        <h2>Import</h2>
        <form action="{{ route('book.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Importar excel</label>
            <input type="file" name="file">
            <button type="submit" class="btn btn-secondary">Cargar</button>
        </div>
        </form>
    </div>

</div>


<div class="container">
   <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Titulo</th>
                <th>Cantidad</th>
                <th>Genero</th>
                <th>Fecha</th>
                <th>Archivo</th>
                <th>Logs</th>
                <th>Accion</th>
                <th>Accion</th>
            </tr>
        </thead>
        @foreach ($books as $book )
            <tbody>
                <tr style="{{ $book->active ? '' : 'background-color:red' }}">
                    <th>{{$book->name}}</th>
                    <th>{{$book->title}}</th>
                    <th>{{$book->count}}</th>
                    <th>{{$book->gender}}</th>
                    <th>{{$book->due_date}}</th>
                    <th>
                        @if ($book->file_path)

                        <a href="{{ asset('storage/' .  $book->file_path) }}" target="_blank"> Ver archivo</a>
                        @else
                        <span>Sin archivo</span>    
                        @endif
                    </th>
                    <th>
                        <a href="{{ route('book.logs', $book->id) }}" class="btn btn-info btn-sm">Ver logs</a>
                    </th>
                    <th><a href="{{ route('book.edit', $book->id) }}">Editar</a></th>
                    <th><a href="{{ route('book.delete', $book->id) }}">Eliminar</a></th>
                </tr>
            </tbody>
            
        @endforeach
    </table>
</div>
@endsection
