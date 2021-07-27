@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Name: {{$user->name}}</h3>
            <h4>Email: {{$user->email}}</h4>
            <h4>Numemo de Publicaciones: .....</h4>
            <h4>Telefono: {{$user->telefono}}</h4>
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
