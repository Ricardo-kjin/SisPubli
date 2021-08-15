@extends('layouts.app')

@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('{{ asset('/storage/images/portada_imagen_inmueble/'.$publicacion->inmueble['foto_principal']) }}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>{{$publicacion->inmueble->titulo}}</h1>
            <span class="subheading">{{$publicacion->user->name}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>


  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-10 mx-auto">
        <h3> {{$publicacion->titulo}}</h3>
        <h4><b> Titulo: </b>{{$publicacion['titulo']}}</h4>
            <p><b> Precio: </b>{{$publicacion['precio']}} $us</p>
            @if ($publicacion->periodo!=null)
            <p><b> Periodo: </b>{{$publicacion['periodo']}} $us</p>
            @endif
            <p><b> Tipo de Publicacion: </b>{{$publicacion->tipopublicacion->nombre}}</p>
      </div>
    </div>
      <div class="row">
        {{-- <div class="col"> --}}
            {{-- <div class="card-columns"> --}}
                <div class="col-lg-12 col-md-10 mx-auto">
                    <h4 style="color: rgb(161, 42, 42)"><b>GALERIA</b></h4>
                </div>

                @foreach ($fotos as $foto)
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <center><img  src="{{ asset('/storage/images/galeria_imagen_inmueble/'.$foto->img) }}" alt="{{ $foto->img }}" width="300" height="300" style="border: 15px solid; color: rgb(255, 255, 255);"></center>
                        </div>
                        {{-- <div class="card-footer" >
                            <form action="{{ route('fotos.destroy', $foto) }}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div> --}}
                    </div>
                </div>
                @endforeach
            {{-- </div> --}}
        {{-- </div> --}}
    </div>
    {{$fotos->links()}}

  </div>

  <hr>

  @endsection

