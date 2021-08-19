@extends('admin.layouts.dashboard')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de Publicaciones</h2>

    </div>

</div>

<!-- DataTables Example -->
<div class="card mb-3">
    {{-- <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example</div> --}}
    <div class="card-body">
        <div class="form-group">
            <a href="{{ route('decargarPDFPublicaciones') }}" target="_blank" class="btn btn-sm btn-danger">Imprimir Tu lista de Publicaciones</a>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Nº</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Duracion</th>
                <th>Tipo de Publicacion</th>
                <th>Nombre del inmueble</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Nº</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Duracion</th>
                <th>Tipo de Publicacion</th>
                <th>Nombre del inmueble</th>
                <th>Tools</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($publicacions as $publicacion)
                    <tr>
                        <td>{{$publicacion['id']}}</td>
                        <td>{{ $publicacion['titulo']}}</td>
                        <td>{{ $publicacion['precio'] }} $us</td>
                        @if ($publicacion->periodo)
                            <td>{{$publicacion->periodo}}</td>
                        @else
                            <td>En venta</td>
                        @endif
                        <td>{{ $publicacion->tipopublicacion->nombre }}</td>
                        <td>{{ $publicacion->inmueble->titulo }}</td>
                        <td width="8%">
                            <a href="/publicacions/{{ $publicacion['id'] }}"><i class="fa fa-eye"></i></a>
                            <a href="/publicacions/{{ $publicacion['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            {{-- <a href="#" data-toggle="modal" data-target="#deleteModal" data-publicacionid="{{$publicacion['id']}}"><i class="fas fa-trash-alt"></i></a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

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
        <div class="modal-body">Seleccione "eliminar" si realmente desea eliminar esta Publicacion.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            <input type="hidden" id="publicacion_id" name="publicacion_id" value="">
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
        </form>
        </div>
    </div>
    </div>
</div>

@section('js_publicacion_page')

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var publicacion_id = button.data('publicacionid')

        var modal = $(this)
        modal.find('.modal-footer #publicacion_id').val(publicacion_id)
        modal.find('form').attr('action','/publicacions/' + publicacion_id);
    })
</script>

@endsection

@endsection
