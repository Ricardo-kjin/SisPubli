@extends('admin.layouts.dashboard')
@section('content')

<h1>Nuevo Proyecto</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/proyectos" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="titulo">titulo</label>
                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo..." value="{{ old('titulo') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">
                    Direccion
                </label>
                <input type="text" name="direccion" class="form-control" id="direccion" placeholder="direccion..." value="{{ old('direccion') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="area_terreno">Area del terreno</label>
                <input type="area_terreno" name="area_terreno" class="form-control" id="area_terreno" placeholder="area_terreno..." value="{{ old('area_terreno') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="area_construida">Area Construida</label>
                <input type="area_construida" name="area_construida" class="form-control" id="area_construida" placeholder="area_construida..." value="{{ old('area_construida') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="area_libre">Area libre</label>
                <input type="area_libre" name="area_libre" class="form-control" id="area_libre" placeholder="area_libre..." value="{{ old('area_libre') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="pisos">Pisos:</label>
                <input type="numeric" name="pisos" class="form-control" id="pisos" placeholder="pisos..." value="{{ old('pisos') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="garajes">Garajes:</label>
                <input type="numeric" name="garajes" class="form-control" id="garajes" placeholder="garajes..." value="{{ old('garajes') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion..." value="{{ old('descripcion') }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="image">Select Image</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="total_cupos">Total de Cupos:</label>
                <input type="numeric" name="total_cupos" class="form-control" id="total_cupos" placeholder="total_cupos..." value="{{ old('total_cupos') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cupo_ocupado">Cupos ocupados:</label>
                <input type="numeric" name="cupo_ocupado" class="form-control" id="cupo_ocupado" placeholder="cupo_ocupado..." value="{{ old('cupo_ocupado') }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="zona"> <b> Seleccione la Zona</b></label>
            <select class="grupo form-control" name="zona" id="zona">
                <option value="">Zonas</option>
                @foreach ($zonas as $zona)
                    <option data-zona-id="{{$zona->id}}" data-zona-slug="{{$zona->descripcion}}" value="{{$zona->id}}">{{$zona->nombre}}</option>
                @endforeach

            </select>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="servicio"> <b> Seleccione los servicios</b></label>

            @foreach ($servicios as $servicio)

                    <div class="form-group" >

                        {{-- <input type="text" data-role="tagsinput" name="servicios_grupos" class="form-control" id="servicios_grupos" value="{{ old('servicios_grupos') }}"> --}}
                        <input type="checkbox" name="servicio[]" id="{{$servicio->empresa}}" value="{{$servicio->id}}" >
                        <label for="{{$servicio->empresa}}">{{$servicio->nombre}}</label>
                    </div>

            @endforeach
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
