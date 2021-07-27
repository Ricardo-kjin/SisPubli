@extends('admin.layouts.dashboard')
@section('content')
<h2>Editar empresa</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/empresas/{{ $user->id }}" enctype="multipart/form-data">
    @method('PATCH')
    @csrf()
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="name">User name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{ $user->name }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre_empresa">Nombre de la empresa:</label>
                <input type="text" name="nombre_empresa" class="form-control" id="nombre_empresa" placeholder="nombre_empresa..." value="{{ $tipo->nombre_empresa }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="registro_empresa">Nº de Registro de la Empresa:</label>
                <input type="text" name="registro_empresa" class="form-control" id="registro_empresa" placeholder="registro_empresa..." value="{{ $tipo->registro_empresa }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nit_empresa">NIT Empresa:</label>
                <input type="text" name="nit_empresa" class="form-control" id="nit_empresa" placeholder="nit_empresa..." value="{{ $tipo->nit_empresa }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion_empresa">Direccion:</label>
                <input type="text" name="direccion_empresa" class="form-control" id="direccion_empresa" placeholder="direccion_empresa..." value="{{ $tipo->direccion_empresa }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ $user->email }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password..." minlength="8">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="password_confirmation">Password Confirm</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="telefono..." value="{{ $user->telefono }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono_empresa">Telefono de la empresa:</label>
                <input type="text" name="telefono_empresa" class="form-control" id="telefono_empresa" placeholder="telefono_empresa..." value="{{ $tipo->telefono_empresa }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="role">Select Role</label>
                <select class="grupo form-control" name="grupo" id="grupo">
                    <option value="">Seleccionar Grupo..</option>
                    @foreach ($grupos as $grupo)
                        <option data-grupo-id="{{$grupo->id}}" data-grupo-slug="{{$grupo->descripcion}}" value="{{$grupo->id_grupos}}" {{ $user->grupos->isEmpty() ? "" : $grupo->nombre == $user->grupos->first()->nombre ? "selected" : ""}}>{{$grupo->nombre}}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>



@endsection
