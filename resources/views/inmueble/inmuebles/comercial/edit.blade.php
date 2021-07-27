@extends('admin.layouts.dashboard')
@section('content')
<h1>Editar Local Comercial</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/localcomercials/{{ $inmueble->id }}" enctype="multipart/form-data">

    @method('PATCH')
    @csrf()
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="titulo">titulo</label>
                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo..." value="{{ $inmueble->titulo }}" required>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">
                    Direccion
                </label>
                <input type="text" name="direccion" class="form-control" id="direccion" placeholder="direccion..." value="{{ $inmueble->direccion }}" required>
            </div>
        </div>
        {{-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="area_terreno">Area del terreno</label>
                <input type="area_terreno" name="area_terreno" class="form-control" id="area_terreno" placeholder="area_terreno..." value="{{ $inmueble->area_terreno }}">
            </div>
        </div> --}}
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="area_construida">Area Construida</label>
                <input type="area_construida" name="area_construida" class="form-control" id="area_construida" placeholder="area_construida..." value="{{ $inmueble->area_construida }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="area_libre">Area libre</label>
                <input type="area_libre" name="area_libre" class="form-control" id="area_libre" placeholder="area_libre..." value="{{ $inmueble->area_libre }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="pisos">Pisos:</label>
                <input type="number" min="0" name="pisos" class="form-control" id="pisos" placeholder="pisos..." value="{{ $inmueble->pisos }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="baños">
                    Baños
                </label>
                <input type="number" min="0" name="baños" class="form-control" id="baños" placeholder="baños..." value="{{ $inmueble->baños }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="habitaciones">
                    Habitaciones
                </label>
                <input type="number" min="0" name="habitaciones" class="form-control" id="habitaciones" placeholder="habitaciones..." value="{{ $inmueble->habitaciones }}" required>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="garajes">Garajes:</label>
                <input type="numeric" name="garajes" class="form-control" id="garajes" placeholder="garajes..." value="{{ $inmueble->garajes }}">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion..." value="{{ $inmueble->descripcion }}" required>
            </div>
        </div>
{{--
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="total_cupo">Total de Cupos:</label>
                <input type="numeric" name="total_cupo" class="form-control" id="total_cupo" placeholder="total_cupo..." value="{{ $inmueble->total_cupo}}">
            </div>
        </div> --}}
        {{-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cupo_ocupado">Cupos ocupados:</label>
                <input type="numeric" name="cupo_ocupado" class="form-control" id="cupo_ocupado" placeholder="cupo_ocupado..." value="{{ $inmueble->cupo_ocupado }}">
            </div>
        </div> --}}
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="zona"> <b> Seleccione la Zona</b></label>
            <select class="grupo form-control" name="zona" id="zona">
                <option value="">Zonas</option>
                @foreach ($zonas as $zona)
                    <option data-zona-id="{{$zona->id}}" data-zona-slug="{{$zona->descripcion}}" value="{{$zona->id}}" {{ $zona->nombre == $inmueble->zona->first()->nombre ? "selected" : ""}}>{{$zona->nombre}}</option>
                @endforeach

            </select>
        </div>



        {{-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div id="permissions_box" >
                .......
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="proyecto"> <b> Seleccione la proyecto</b></label>
            <select class="grupo form-control" name="proyecto" id="proyecto">
                <option value="">proyectos</option>
                @foreach ($proyectos as $proyecto)
                    <option id="{{$proyecto->id}}" data-proyecto-slug="{{$proyecto->titulo}}" value="{{$proyecto->id}}" {{ $inmueble->inmuebles==null ? "" :  $proyecto->titulo == $inmueble->inmuebles->titulo ? "selected" : ""}}>{{$proyecto->titulo}}</option>
                @endforeach

            </select>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="servicio"> <b> Seleccione los servicios</b></label>

            @foreach ($servicios as $servicio)

                    <div class="form-group" >

                        {{-- <input type="text" data-role="tagsinput" name="servicios_grupos" class="form-control" id="servicios_grupos" value="{{ old('servicios_grupos') }}"> --}}
                        <input type="checkbox" name="servicio[]" id="{{$servicio->empresa}}" value="{{$servicio->id}}" {{ in_array($servicio->id, $inmueble->servicios->pluck('id')->toArray() ) ? 'checked="checked"' : '' }}>
                        <label for="{{$servicio->empresa}}">{{$servicio->nombre}}</label>
                    </div>

            @endforeach
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group" >
                <label for="image"><b>Select Image</b></label>
                <input type="file" name="image" class="form-control-file" id="profile-img" value="{{$inmueble->foto_principal}}">
                <div class="row">
                    <img src="{{ asset('/storage/images/portada_imagen_inmueble/'.$inmueble->foto_principal) }}" id="profile-img-tag" class="img-thumbnail mx-auto" alt="{{$inmueble->foto_principal}}" width="250" >
                </div>
            </div>
        </div>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
