@extends('layouts.app')

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/se_alquila.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>EN Alquiler</h1>
            <span class="subheading">Inmuebles en Alquiler</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->

  <div class="container-fluid">

    {{-- <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"> --}}
        <div class="row">
            <div class="col-md-3 mt-3">
                <div class="container-fluid">
                    <h4><strong>Filtros para la busqueda:</strong></h4>
                    {{-- <div class="container-fluid"> --}}
                        <form >
                            {{-- <div class="form-group">
                                <label for="tipopublicacion"> <b> Tipo de Publicacion</b></label>
                                <select class="form-control" name="tipopublicacion" id="tipopublicacion">
                                    <option value="">Seleccione uno...</option>
                                    @foreach ($tipopublicacions as $tipopublicacion)
                                        <option data-tipopublicacion-id="{{$tipopublicacion->id}}" data-tipopublicacion-slug="{{$tipopublicacion->descripcion}}" value="{{$tipopublicacion->id}}">{{$tipopublicacion->nombre}}</option>
                                    @endforeach

                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="zona"> <b>Zona</b></label>
                                <select class="form-control" name="zona" id="zona">
                                    {{-- <option value="{{$filtro['zona']}}">Zonas</option> --}}
                                    @foreach ($zonas as $zona)
                                        <option data-zona-id="{{$zona->id}}" data-zona-slug="{{$zona->descripcion}}" value="{{$zona->nombre}}">{{$zona->nombre}}</option>
                                    @endforeach

                                </select>
                            </div>
                            {{-- <div class="form-goup">
                                <label for="servicio">
                                    <b>Seleccione los servicios</b>
                                </label>

                                @foreach ($servicios as $servicio)
                                    <div class="form-group" >
                                        <label for="{{$servicio->empresa}}"> --}}
                                        {{-- <input type="text" data-role="tagsinput" name="servicios_grupos" class="form-control" id="servicios_grupos" value="{{ old('servicios_grupos') }}"> --}}
                                        {{-- <input type="checkbox" name="servicio[]" id="{{$servicio->empresa}}" value="{{$servicio->id}}" >
                                        <FOnt size="2">{{$servicio->nombre}}</FOnt></label>
                                    </div>
                                @endforeach
                            </div> --}}
                            <div class="form-group">
                                <label for="precio">Precio(max):  </label>
                                <input type="decimal" name="precio" class="form-control" id="precio" placeholder="Precio ($us) ..." value="{{$filtro['precio']}}" >
                            </div>
                            <div class="form-group">
                                <label for="baños">Baños:</label>
                                <input type="numeric" name="baños" class="form-control" id="baños" placeholder="Baños..." value="{{$filtro['baños']}}" >
                            </div>
                            <div class="form-group">
                                <label for="habitacion">Habitacion:</label>
                                <input type="numeric" name="habitacion"  class="form-control" id="habitacion" placeholder="habitacion..." value="{{$filtro['habitacion']}}" >
                            </div>
                            <div class="form-group">
                                <label for="garaje">Garaje:</label>
                                <input type="numeric" name="garaje"  class="form-control" id="garaje" placeholder="garaje..." value="{{$filtro['garaje']}}" >
                            </div>
                            <div class="form-group">
                                <label for="pisos">pisos:</label>
                                <input type="numeric" name="pisos" class="form-control" id="pisos" placeholder="pisos..." value="{{$filtro['pisos']}}" >
                            </div>

                            <div class="form-group pt-2">
                                <input class="btn btn-success" type="submit" value="Buscar">
                            </div>
                        </form>
                    {{-- </div> --}}
                </div>
            </div>
            <div class="row col-md-9 mx-auto">
                @foreach ($publicacions as $publicacion)
                    <div class="col-md-4">
                        <img class="img-thumbnail mt-4" style="width:300px !important; height:300px !important" src="{{ asset('/storage/images/portada_imagen_inmueble/'.$publicacion->foto_principal)  }}" alt="Foto Principal">
                    </div>
                    <div class="col-md-5">
                        <div class="post-preview">
                            <a href="/home/{{$publicacion->id}}">
                                <h2 class="post-title" style="">
                                    {{$publicacion->titulo}} <br>->{{$publicacion->precio}} $us
                                </h2>
                                <h3 class="post-subtitle">
                                    <b>{{$publicacion->titulo}}</b>: {{$publicacion->descripcion}}
                                </h3>
                            </a>
                            <p class="post-meta">Publicado por:
                                <a href="#">
                                    {{$publicacion->name}}
                                </a>
                                en {{$publicacion->fecha_inicio}}
                            </p>
                        </div>
                        </div>
                        <hr>
                @endforeach
            </div>
            {{-- <div class="post-preview">
            <a href="post.html">
                <h2 class="post-title">
                I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
                </h2>
            </a>
            <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on September 18, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
            <a href="post.html">
                <h2 class="post-title">
                Science has not yet mastered prophecy
                </h2>
                <h3 class="post-subtitle">
                We predict too much for the next year and yet far too little for the next ten.
                </h3>
            </a>
            <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on August 24, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
            <a href="post.html">
                <h2 class="post-title">
                Failure is not an option
                </h2>
                <h3 class="post-subtitle">
                Many say exploration is part of our destiny, but it’s actually our duty to future generations.
                </h3>
            </a>
            <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on July 8, 2019</p>
            </div>
            <hr> --}}



            {{-- <div class="clearfix">
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div> --}}

        </div>
        <!-- Pager -->
        {{$publicacions->links()}}
    {{-- </div> --}}

  </div>

  <hr>
  @endsection
