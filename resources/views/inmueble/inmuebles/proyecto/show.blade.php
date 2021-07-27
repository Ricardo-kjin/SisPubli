@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card-header">
        <div class="row">
            <div class="card card-warning">
                <div class="card-header">
                    <h2 class="card-signin">{{$inmueble->titulo}}</h2>
                </div>
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
                    <p>Zona:{{$inmueble->zona->nombre}}</p>
                    {{-- <p>Habitaciones:{{$inmueble->habitaciones}}</p>
                    <p>Baños:{{$inmueble->baños}}</p> --}}
                    <p>Pisos:{{$inmueble->pisos}}</p>
                    <p>Garajes:{{$inmueble->garajes}}</p>
                    <p>Zona:{{$inmueble->zona->nombre}}</p>
                    <p>Tipo de inmueble:{{$inmueble->tipoinmueble->nombre}}</p>
                    {{-- <p>Inmuebles asociados:
                    @if ($inmueble->proyecto)
                        @foreach ($inmueble->proyecto as $serv)
                            {{$serv->titulo}},
                        @endforeach
                    @endif
                    </p> --}}
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
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Direccion</th>
                <th>Superficie(m2)</th>
                <th>Pisos</th>
                <th>Garajes</th>
                <th>Foto Portada</th>
                <th>Proyecto</th>

            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Direccion</th>
                <th>Superficie(m2)</th>
                <th>Pisos</th>
                <th>Garajes</th>
                <th>Foto Portada</th>
                <th>Proyecto</th>

            </tr>
            </tfoot>
            <tbody>
                @if ($inmueble->proyecto)
                    @foreach ($inmueble->proyecto as $inmueble)
                        <tr>
                            <td>{{ $inmueble['id'] }}</td>
                            <td>{{ $inmueble['titulo'] }}</td>
                            <td>{{ $inmueble['direccion'] }}</td>
                            <td>Total:{{ $inmueble['area_terreno'] }}<br>Construida:{{ $inmueble['area_construida'] }} <br> Libre:{{ $inmueble['area_libre'] }}</td>

                            <td>{{ $inmueble['pisos'] }}</td>
                            <td>{{ $inmueble['garajes'] }}</td>
                            <td> <center> <img src="{{ asset('/storage/images/portada_imagen_inmueble/'.$inmueble['foto_principal']) }}" alt="{{ $inmueble['foto_principal'] }}" style="max-height: 100px;"></center></td>
                            <td>{{ $inmueble->tipoinmueble->nombre }}</td>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        </div>
    </div>


    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>

</div>

@endsection
