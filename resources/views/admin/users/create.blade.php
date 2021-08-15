@extends('admin.layouts.dashboard')
@section('content')

<h1>Crear Nuevo Usuario</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/users" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre..." value="{{ old('name') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nit">NIT</label>
                <input type="text" nit="nit" class="form-control" id="nit" placeholder="Nombre..." value="{{ old('nit') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ old('email') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password..." required minlength="8">
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
                <label for="fecha_nac">Fecha de nacimiento</label>
                <input type="date" name="fecha_nac" class="form-control" id="fecha_nac" placeholder="fecha_nac..." value="{{ old('fecha_nac') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">User telefono</label>
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
        {{-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div id="permissions_box" >
                .......
            </div>
        </div> --}}
    </div>

    <div class="form-group pt-2">

        <input class="btn btn-success" type="submit" value="Crear">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
