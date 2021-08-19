@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Publicacion: {{$consulta->publicacion->titulo}}</h3>
            <h4>Inmueble: {{$consulta->publicacion->inmueble->titulo}}</h4>
        </div>
        <div class="card-body">
            <p><b>Nombre:</b> {{$consulta->nombre}} </p>
            <p><b>Telefono:</b> {{$consulta->telefono}} </p>
            <p><b>Correo:</b> {{$consulta->email}} </p>
            <p><b>Contenido:</b> {{$consulta->descripcion}} </p>
            {{-- <p>Nombre: {{$consulta->nombre}} </p> --}}
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>

@endsection
