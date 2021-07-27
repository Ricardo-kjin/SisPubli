@extends('admin.layouts.dashboard')
@section('content')
<h1>Editar tipo de inmuebles</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/tipopagos/{{$tipopago->id_tipo_pagos}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="nombre">Nombre del tipo de inmueble</label>
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre ..." value="{{$tipopago->nombre}}" >
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion del tipopago</label>
        <input type="text" name="descripcion" tag="descripcion" class="form-control" id="descripcion" placeholder="Role Slug..." value="{{$tipopago->descripcion}}" >
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
