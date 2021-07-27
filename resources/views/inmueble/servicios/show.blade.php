@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Nombre: {{$servicio['nombre']}}</h3>
            <h3>Empresa: {{$servicio['empresa']}}</h3>
            <h4>Descipcion: {{$servicio['descripcion']}}</h4>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>

@endsection
