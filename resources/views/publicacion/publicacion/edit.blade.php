@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card-header">
        <div class="row">

            <div class="header">
                <h2>{{$inmueble->titulo}}</h2>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- ////////////////////////////////////////////////////// --}}
        <form method="POST" action="/publicacions/{{ $publicacion->id }}">
            @method('PATCH')
            {{ csrf_field() }}
            {{-- <label for="acceso"> <b> Seleccione los Accesos</b></label>
            <div class="row">
            @foreach ($tipopublicacions as $acceso)
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group" >

                        {{-- <input type="text" data-role="tagsinput" name="accesos_grupos" class="form-control" id="accesos_grupos" value="{{ old('accesos_grupos') }}"> --}}
                        {{--<input type="checkbox" name="acceso[]" id="{{$acceso->descripcion}}" value="{{$acceso->id_accesos}}" >
                        <label for="{{$acceso->descripcion}}">{{$acceso->nombre}}</label>
                    </div>
                </div>
                @endforeach
            </div> --}}
            <div class="form-group">
                <label for="tipopublicacion_id">Seleccione Tipo</label>
                <select class="tipopublicacion_id form-control" name="tipopublicacion_id" id="tipopublicacion_id">
                    <option value="">Selecionar Tipo...</option>
                    @foreach ($tipopublicacions as $tipopublicacion)
                        <option data-tipopublicacion-id="{{$tipopublicacion->id}}" data-tipopublicacion-slug="{{$tipopublicacion->nombre}}" value="{{$tipopublicacion->id}}" {{ $tipopublicacion->nombre == $publicacion->tipopublicacion->nombre ? "selected" : ""}}>{{$tipopublicacion->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" class="form-control" id="titulo" value="{{ $publicacion->titulo }}" >
            </div>
            <input type="numeric" name="inmueble_id" id="inmueble_id" readonly="readonly" value="{{ $publicacion->inmueble->id }}" hidden>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="decimal" name="precio" class="form-control" id="precio"  value="{{ $publicacion->precio }}" >
            </div>
            <div class="form-group" id="div" style="{{empty($publicacion->periodo) ? 'display: none;' :""}}"> <!--style="display: none;"<-->
                <label for="duracion">Duracion:</label>
                <input type="text" name="duracion" tag="duracion" class="form-control" id="duracion"  value="{{$publicacion->periodo}}" >
            </div>
            <div class="form-group pt-2">
                <input class="btn btn-success" type="submit" value="Publicar">
                <a  href="{{ route('publicacions.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
        {{-- ////////////////////////////////////////////////////// --}}
        {{-- <p align="right">
            <a  href="{{ route('inmuebles.index') }}" class="btn btn-danger btn-lg">Cancelar</a>
            <a href="/grupos/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true"><b class="fas fa-plus"></b> publicar</a>
        </p> --}}
        {{-- <div class="col-md-6">
            <a href="/grupos/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true"><b class="fas fa-plus"></b> Agregar Grupo  </a>
        </div> --}}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <p><b>Direccion:</b> {{$inmueble->direccion}}</p>
                    <p><b>Area del Terreno:</b> {{$inmueble->area_terreno}}</p>
                    <p><b>Area Construida:</b> {{$inmueble->area_construida}}</p>
                    <p><b>Area libre:</b> {{$inmueble->area_libre}}</p>
                    <p><b>Habitaciones:</b> {{$inmueble->habitaciones}}</p>
                    <p><b>Baños:</b> {{$inmueble->baños}}</p>
                    <p><b>Pisos:</b> {{$inmueble->pisos}}</p>
                    <p><b>Garajes:</b> {{$inmueble->garajes}}</p>
                    <p><b>Zona:</b> {{$inmueble->zona->nombre}}</p>
                    <p><b>Tipo de inmueble:</b> {{$inmueble->tipoinmueble->nombre}}</p>
                    @if ($inmueble->inmuebles)
                        @if ($inmueble->inmuebles->titulo)
                            <p><b>Proyecto:</b> {{$inmueble->inmuebles->titulo}}</p>

                        @endif
                    @endif
                    <p><b>Servicios:</b>
                        @foreach ($inmueble->servicios as $serv)
                            {{$serv->nombre}},
                        @endforeach
                    </p>
                </div>
            </div>
            <div>

                <img src="{{ asset('/storage/images/portada_imagen_inmueble/'.$inmueble->foto_principal)}}" width="350" alt="" style="float:left; margin-right:20px;">
                <p><center><b>Descripcion: </b>{!!$inmueble->descripcion!!}</center></p>
            </div>
        </div>
    </div>
    {{-- <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div> --}}
    {{-- <div class="form-group">
        <label for="imagenes">Añadir Fotos</label>
        <input type="file" class="form-control-file" name="imagenes[]" id="imagenes[]" multiple accept="images/*">
    </div> --}}
    <!--div class="card">
        <div class="card-header">
            <h3 class="card-title" style="color: rgb(221, 94, 94)"> <b> Agregar Imagenes </b></h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/fotos" enctype="multipart/form-data">
                {{-- @csrf --}}
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
    </div-->
    {{-- <div class="container"> --}}
        <div class="card-header">
            <h3 class="card-title" style="color: rgb(221, 94, 94)"> <b> Galeria </b></h3>
        </div>
        <div class="row">
            {{-- <div class="col"> --}}
                {{-- <div class="card-columns"> --}}

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

@section('js_publicacions_page')

    <script>
        $(document).ready(function(){
            var permissions_box = $('#div');

            // permissions_box.hide(); // hide all boxes
            $('#tipopublicacion_id').on('change', function() {
                var tipopublicacion = $(this).find(':selected');
                var tipopublicacion_id = tipopublicacion.data('tipopublicacion-id');
                var tipopublicacion_slug = tipopublicacion.data('tipopublicacion-slug');

                if (tipopublicacion_slug=="Venta") {
                    permissions_box.hide();
                    // console.log(tipopublicacion_slug)
                } else {
                    permissions_box.show();
                }
                // permissions_ckeckbox_list.empty();

            });
        });
    </script>

@endsection

@endsection
