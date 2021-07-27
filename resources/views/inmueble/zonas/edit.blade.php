@extends('admin.layouts.dashboard')
@section('content')
<h1>Editar Acceso</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/zonas/{{$zona->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="nombre">Nombre de la zona</label>
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del zona..." value="{{$zona->nombre}}" >
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion de la zona</label>
        <input type="text" name="descripcion" tag="descripcion" class="form-control" id="descripcion" placeholder="Role Slug..." value="{{$zona->descripcion}}" >
    </div>
    <div class="form-group">
        <label for="url">url de la zona</label>
        <input type="text" name="url" tag="url" class="form-control" id="url" placeholder="Role Slug..." value="{{$zona->url}}" >
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
