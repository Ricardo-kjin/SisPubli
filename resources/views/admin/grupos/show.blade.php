@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Nombre: {{$grupo['nombre']}}</h3>
            <h4>Descipcion: {{$grupo['descripcion']}}</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Acceso</h5>
            <p class="card-text">
                @if ($grupo->accesos != null)

                    @foreach ($grupo->accesos as $acceso)
                        <span class="badge badge-info">
                            {{ $acceso->nombre }}
                        </span>
                    @endforeach

                @endif
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>

@endsection
