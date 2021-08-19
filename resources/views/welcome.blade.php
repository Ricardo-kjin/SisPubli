@extends('layouts.app')

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/imagen_portada.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Sistema Publicitario</h1>
            <span class="subheading">Publicita Aqui</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="col-lg-12 col-md-10 mx-auto">
        <div class="row">
            @foreach ($publicacions as $publicacion)
            <div class="col-md-4">
                <img class="img-thumbnail mt-4" style="width:300px !important; height:300px !important" src="{{ asset('/storage/images/portada_imagen_inmueble/'.$publicacion->inmueble['foto_principal'])  }}" alt="Foto Principal">
            </div>
            <div class="col-lg-8">
                <div class="post-preview">
                    <a href="/home/{{$publicacion->id}}">
                        <h2 class="post-title" style="">
                            {{$publicacion->titulo}} <br>->{{$publicacion->precio}} $us
                        </h2>
                        <h3 class="post-subtitle">
                            <b>{{$publicacion->inmueble->titulo}}</b>: {{$publicacion->inmueble->descripcion}}
                        </h3>
                    </a>
                    <p class="post-meta">Publicado por:
                        <a href="#">
                            {{$publicacion->user->name}}
                        </a>
                        en {{$publicacion->fecha_inicio}}
                    </p>
                </div>
                </div>
                <hr>
            @endforeach

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
    </div>
  </div>

  <hr>
  @endsection
