<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Crear libros</h2>
    <form action="{{ route('book.create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label> Nombre del autor</label>
        <input type="text" name="name" required>
    </div>
    <br>
    <div>
        <label> Titulo del autor</label>
        <input type="text" name="title" required>
    </div>
    <br>
    <div>
        <label> Cantidad de libros</label>
        <input type="number" name="count" required min="0">
    </div>
    <br>
    <div>
        <label>Fecha de vencimiento del libro</label>
        <input type="date" name="due_date" required>
    </div>
    <br>
    <div>
        <label> Genero de libro</label>
        <select name="gender">
            <option value="">Seleccionar</option>
            <option value="accion">Accion</option>
            <option value="comedia">Comedia</option>
            <option value="ficcion">Ficcion</option>
        </select>
    </div>
    <br>
    <div>
        <label>Subir archivo</label>
        <input type="file" name="file" accept=".pdf,.doc,.docx" required >
    </div>
    <br>
    <button type="submit">Enviar</button>
    </form>
    <hr>
   
    <div>
         <h2>Eliminar todos los libros</h2>
         <form action="{{ route('book.destroy') }}" method="POST" onsubmit="return confirm('Estas seguro chiquito?')">
            @csrf
            <div>
                <label>Eliminar libros</label>
                <button type="submit">Eliminar</button>
            </div>
         </form>
    </div>
    <hr>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Titulo</th>
                <th>Cantidad</th>
                <th>Genero</th>
                <th>Fecha</th>
                <th>Archivo</th>
                <th>Accion</th>
                <th>Accion</th>
            </tr>
        </thead>

        @foreach ($books as $book)
            <tbody>
                <tr>
                    <th>{{$book->name}}</th>
                    <th>{{$book->title}}</th>
                    <th>{{$book->count}}</th>
                    <th>{{$book->gender}}</th>
                    <th>{{$book->due_date}}</th>
                    <th>
                        @if ($book->file_path)
                            <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank">Ver archibo</a>
                        @else
                            <span>Sin archivo</span>
                        @endif
                    </th>
                    <th><a href="{{ route('book.edit', $book->id) }}">Editar</a></th>
                    <th><a href="{{ route('book.delete', $book->id) }}">Eliminar</a></th>
                </tr>
            </tbody>
        @endforeach
    </table>
</body>
</html>