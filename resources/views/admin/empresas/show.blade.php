@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><b>Empresa:</b> {{$user->name}}</h3>
            <h3><b>Nombre Socio:</b> {{$user->tipousuarios->nombre_empresa}}</h3>
            <h6><b>Email:</b> {{$user->email}}</h6>
            <h6><b>Numemo de Publicaciones:</b> 5</h6>
            <h6><b>Telefono: </b>{{$user->telefono}}</h6>
            <h6><b>Contacto para la Empresa: </b>{{$user->tipousuarios->telefono_empresa}}</h6>
            <h6><b>Nit:</b> {{$user->tipousuarios->nit_empresa}}</h6>
            <h6><b>Direccion:</b> {{$user->tipousuarios->direccion_empresa}}</h6>
        </div>
        <div class="card-body">
            <h5 class="card-title">Grupo</h5>
            <p class="card-text">
                <span class="badge badge-success">
                    {{ $user->grupos->first()->nombre }}
                </span>
            </p>
            <h5 class="card-title">Acceso</h5>
            <p class="card-text">
                @if ($user->grupos->isNotEmpty())
                    @foreach ($user->grupos->first()->accesos as $acceso)
                        <span class="badge badge-success">
                            {{ $acceso->nombre }}
                        </span>
                    @endforeach
                @endif
            </p>

        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>

@endsection
