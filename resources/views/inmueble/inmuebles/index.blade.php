@extends('admin.layouts.dashboard')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de Inmuebles</h2>
    </div>
    <div class="col-md-6">
        <a class="nav-link dropdown-toggle float-md-right" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="btn btn-success">Agregar Inmueble </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('proyectos.create') }}" style="color: green">Proyecto</a>
            <a class="dropdown-item" href="{{ route('apartamentos.create') }}" style="color: green">Apartamento </a>
            <a class="dropdown-item" href="{{ route('inmuebles.create') }}" style="color: green">Inmueble particular</a>
            <a class="dropdown-item" href="{{ route('localcomercials.create') }}" style="color: green">Local Comercial</a>
            <a class="dropdown-item" href="{{ route('lotes.create') }}" style="color: green">Lote</a>
          </div>

        {{-- <a href="/inmuebles/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true"><b class="fas fa-plus"></b> Agregar tipo  </a> --}}
    </div>
</div>

<!-- DataTables Example -->
<div class="card mb-3">
    {{-- <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example</div> --}}
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Nº</th>
                <th>Publicar</th>
                <th>Titulo</th>
                <th>Direccion</th>
                <th>Superficie(m2)</th>
                {{-- <th>Pisos</th> --}}
                {{-- <th>Garajes</th> --}}
                <th>Foto Portada</th>
                <th>Proyecto</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Nº</th>
                <th>Publicar</th>
                <th>Titulo</th>
                <th>Direccion</th>
                <th>Superficie(m2)</th>
                {{-- <th>Pisos</th> --}}
                {{-- <th>Garajes</th> --}}
                <th>Foto Portada</th>
                <th>Proyecto</th>
                <th>Tools</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($inmuebles as $inmueble)
                    <tr>
                        {{-- @if (!$inmueble->with('publicacion'))
                            <td><a href="{{ route('publicacions.create') }}" method="get" > <p style="color: rgb(255, 0, 0)">Publicar</p> </a></td>
                        @else
                        <td><a href="{{ route('publicacions.create') }}" method="get" > <p style="color: rgb(0, 255, 55)">Publicar</p> </a></td>
                        @endif --}}
                        <td>{{$inmueble['id']}}</td>
                        @if ($inmueble->publicacions->isEmpty())
                            {{-- <td><a href="#" data-toggle="modal" data-target="#Modal_publi"><p style="color: rgb(255, 0, 0)">Publicar</p></a></td> --}}
                            <td><a href="{{ route('crear', $inmueble) }}" method="get" ><p style="color: rgb(0, 255, 55)">Publicar</p></a></td>
                        @else
                            <td><a href="#" data-toggle="modal" data-target="#Modal_publi"><p style="color: rgb(255, 0, 0)">Publicado</p></a></td>
                            {{-- <td><a href="{{ route('crear', $inmueble) }}" method="get" ><p style="color: rgb(0, 255, 55)">Publicar</p></a></td> --}}
                        @endif
                        <td>{{ $inmueble['titulo']}}</td>
                        <td>{{ $inmueble['direccion'] }}</td>
                        <td>Total:{{ $inmueble['area_terreno'] }}<br>Construida:{{ $inmueble['area_construida'] }} <br> Libre:{{ $inmueble['area_libre'] }}</td>

                        {{-- <td>{{ $inmueble['pisos'] }}</td> --}}
                        {{-- <td>{{ $inmueble['garajes'] }}</td> --}}
                        <td><center><img src="{{ asset('/storage/images/portada_imagen_inmueble/'.$inmueble['foto_principal']) }}" alt="{{ $inmueble['foto_principal'] }}" style="max-height: 100px;"></center></td>
                        <td>{{ $inmueble->tipoinmueble->nombre }}</td>
                        <td width="8%">
                            <a href="/inmuebles/{{ $inmueble['id'] }}"><i class="fa fa-eye"></i></a>
                            <a href="/inmuebles/{{ $inmueble['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-inmuebleid="{{$inmueble['id']}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
<!-- msm de modal-->
<div class="modal fade" id="Modal_publi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: red"><b> AVISO!</b></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            El Inmueble Ya ha sido Publicado!
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
    </div>
</div>
<!-- fin modal-->

<!-- delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguguro de querer eliminar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">Seleccione "eliminar" si realmente desea eliminar este inmueble.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            <input type="hidden" id="inmueble_id" name="inmueble_id" value="">
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
        </form>
        </div>
    </div>
    </div>
</div>

@section('js_inmueble_page')

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var inmueble_id = button.data('inmuebleid')

        var modal = $(this)
        modal.find('.modal-footer #inmueble_id').val(inmueble_id)
        modal.find('form').attr('action','/inmuebles/' + inmueble_id);
    })
</script>

@endsection

@endsection
