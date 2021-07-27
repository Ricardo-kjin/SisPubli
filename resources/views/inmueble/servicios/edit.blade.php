@extends('admin.layouts.dashboard')
@section('content')
<h1>Editar servicio</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/servicios/{{$servicio->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="nombre">Nombre del servicio</label>
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del servicio..." value="{{$servicio->nombre}}" >
    </div>
    <div class="form-group">
        <label for="empresa">Nombre de La Empresa</label>
        <input type="text" name="empresa" class="form-control" id="empresa" placeholder="Nombre del empresa..." value="{{$servicio->empresa}}" >
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion del servicio</label>
        <input type="text" name="descripcion" tag="descripcion" class="form-control" id="descripcion" placeholder="Role Slug..." value="{{$servicio->descripcion}}" >
    </div>


    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
