@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Nombre: {{$zona['nombre']}}</h3>
            <h4>Descipcion: {{$zona['descripcion']}}</h4>
            <h4>Url: {{$zona['url']}}</h4>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>

@endsection
