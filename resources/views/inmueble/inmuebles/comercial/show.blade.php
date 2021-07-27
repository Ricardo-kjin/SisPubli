@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card-header">
        <div class="row">
            <div class="header">
                <h2>{{$inmueble->titulo}}</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <p>Direccion:{{$inmueble->direccion}}</p>
                    <p>Area del Terreno:{{$inmueble->area_terreno}}</p>
                    <p>Area Construida:{{$inmueble->area_construida}}</p>
                    <p>Area libre:{{$inmueble->area_libre}}</p>
                    <p>Habitaciones:{{$inmueble->habitaciones}}</p>
                    <p>Baños:{{$inmueble->area_libre}}</p>
                    <p>Pisos:{{$inmueble->area_libre}}</p>
                    <p>Garajes:{{$inmueble->area_libre}}</p>
                    <p>Zona:{{$inmueble->zona->nombre}}</p>
                    <p>Tipo de inmueble:{{$inmueble->tipoinmueble->nombre}}</p>
                    @if ($inmueble->inmuebles)
                        @if ($inmueble->inmuebles->titulo)
                            <p>Proyecto: {{$inmueble->inmuebles->titulo}}</p>

                        @endif
                    @endif
                    <p>Servicios:
                        @foreach ($inmueble->servicios as $serv)
                            {{$serv->nombre}},
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="content" style="margin-top:30px">

                <img src="{{ asset('/storage/images/portada_imagen_inmueble/'.$inmueble->foto_principal)}}" width="350" alt="" style="float:left; margin-right:20px;">
                <p>Descripcion:{!!$inmueble->descripcion!!}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>

</div>

@endsection
