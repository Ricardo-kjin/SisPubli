@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><b> Inmueble:</b> <br>  {{$publicacion->inmueble->titulo}}</h3>

        </div>
        <div class="card-body">
            <h4><b> Titulo: </b>{{$publicacion['titulo']}}</h4>
            <h4><b> Precio: </b>{{$publicacion['precio']}} $us</h4>
            @if ($publicacion->periodo!=null)
            <h4><b> Periodo: </b>{{$publicacion['periodo']}} $us</h4>
            @endif
            <h4><b> fecha de inicio: </b>{{$publicacion['fecha_inicio']}}</h4>
            <h4><b> Fecha final: </b>{{$publicacion['fecha_fin']}}</h4>
            <h4><b> Tipo de Publicacion: </b>{{$publicacion->tipopublicacion->nombre}}</h4>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>

@endsection
