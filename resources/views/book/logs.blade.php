@extends('layouts.app')

@section('content')
<div class="container p-3 my-3 border">
    <h2 class="text-center mb-4">Registro de Actividades</h2>

    <table class="table table-striped text-center align-middle shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Libro</th>
                <th>Acción</th>
                <th>Detalles</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->book->title ?? 'N/A' }}</td>
                    <td>{{ ucfirst($log->event->name) }}</td>
                    <td class="text-start">
                        @if($log->details)
                            @php
                                $changes = json_decode($log->details, true);
                            @endphp
                            <ul class="mb-0">
                                @foreach($changes as $field => $value)
                                    <li>
                                        <strong>{{ ucfirst($field) }}:</strong>
                                        @if(is_array($value))
                                            {{ json_encode($value, JSON_UNESCAPED_UNICODE) }}
                                        @else
                                            {{ $value }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('book.index') }}"  class="btn btn-success">Regresar</a>
</div>
@endsection
