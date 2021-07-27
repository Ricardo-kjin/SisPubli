@extends('admin.layouts.dashboard')
@section('content')
<h2>Editar Agente</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/agentes" enctype="multipart/form-data">
    @csrf()
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{ old('name') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="profesion">Profesion</label>
                <input type="text" name="profesion" class="form-control" id="profesion" placeholder="profesion..." value="{{ old('profesion') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nit_agente">NIT</label>
                <input type="text" name="nit_agente" class="form-control" id="nit_agente" placeholder="nit_agente..." value="{{ old('nit_agente') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password..." minlength="8" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="password_confirmation">Password Confirm</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation" >
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="telefono..." value="{{ old('telefono') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <select class="grupo form-control" name="grupo" id="grupo">
                <option value="">Seleccionar Grupo</option>
                @foreach ($grupos as $grupo)
                    <option data-grupo-id="{{$grupo->id}}" data-grupo-slug="{{$grupo->descripcion}}" value="{{$grupo->id_grupos}}">{{$grupo->nombre}}</option>
                @endforeach

            </select>
        </div>

    </div>
    <div class="form-group pt-2">
        <input class="btn btn-success" type="submit" value="Crear">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
