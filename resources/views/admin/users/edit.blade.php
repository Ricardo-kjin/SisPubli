@extends('admin.layouts.dashboard')
@section('content')
<h2>Editar Usuario</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/users/{{ $user->id }}" enctype="multipart/form-data">
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
                <label for="nit">NIT</label>
                <input type="text" name="nit" class="form-control" id="nit" placeholder="nit..." value="{{ $user->tipousuarios->nit_agente }}" required>
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
                <label for="role">Select Role</label>
                <select class="grupo form-control" name="grupo" id="grupo">
                    <option value="">Seleccionar Grupo..</option>
                    @foreach ($grupos as $grupo)
                        <option data-grupo-id="{{$grupo->id_grupos}}" data-grupo-slug="{{$grupo->descripcion}}" value="{{$grupo->id_grupos}}" {{ $user->grupos->isEmpty() ? "" : $grupo->nombre == $user->grupos->first()->nombre ? "selected" : ""}}>{{$grupo->nombre}}</option>
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
