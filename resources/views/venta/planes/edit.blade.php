@extends('admin.layouts.dashboard')
@section('content')
<h1>Editar Plan</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/planes/{{$plane->id_planes}}">

    @method('PATCH')
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" id_planes="nombre" placeholder="Nombre ..." value="{{$plane->nombre}}" >
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion del plane</label>
        <input type="text" name="descripcion" tag="descripcion" class="form-control" id_planes="descripcion" placeholder="Role Slug..." value="{{$plane->descripcion}}" >
    </div>


    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
