@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card-header">
        <div class="row">
            <div class="header">
                <h2>{{$inmueble->titulo}}</h2>
            </div>
        </div>
        <p align="right">
            <a  href="{{ route('inmuebles.index') }}" class="btn btn-primary">Atras</a>
        </p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <p>Direccion:{{$inmueble->direccion}}</p>
                    <p>Area del Terreno:{{$inmueble->area_terreno}}</p>
                    <p>Area Construida:{{$inmueble->area_construida}}</p>
                    <p>Area libre:{{$inmueble->area_libre}}</p>
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
    {{-- <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div> --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="color: rgb(221, 94, 94)"> <b> Agregar Imagenes </b></h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/fotos" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <input type="numeric" name="id_inmueble" class="form-control" id="id_inmueble" value="{{$inmueble->id}}" hidden>
                    </div>

                    <div class="form-group">
                        {{-- <label for="image">Añadir Fotos</label> --}}
                        <input type="file" class="form-control-file" name="image[]" id="image[]"  accept="image/*" multiple>
                    </div>
                </div>
                <div class="form-group pt-2">
                    <input class="btn btn-success" type="submit" value="Agregar">
                    {{-- <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a> --}}
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="container"> --}}
        <div class="row">
            {{-- <div class="col"> --}}
                {{-- <div class="card-columns"> --}}
                    @foreach ($fotos as $foto)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <center><img  src="{{ asset('/storage/images/galeria_imagen_inmueble/'.$foto->img) }}" alt="{{ $foto->img }}" width="300" height="300" style="border: 15px solid; color: rgb(255, 255, 255);"></center>
                            </div>
                            <div class="card-footer" >
                                <form action="{{ route('fotos.destroy', $foto) }}" class="d-inline" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
        {{$fotos->links()}}
</div>

@endsection
