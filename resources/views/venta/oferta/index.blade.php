@extends('admin.layouts.dashboard')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de Oferta</h2>
    </div>
    <div class="col-md-6">
        {{-- <a class="nav-link dropdown-toggle float-md-right" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="btn btn-success">Agregar oferta </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">

            <a class="dropdown-item" href="{{ route('proyectos.create') }}" style="color: green">Proyecto</a>
            <a class="dropdown-item" href="{{ route('apartamentos.create') }}" style="color: green">Apartamento </a>
            <a class="dropdown-item" href="{{ route('ofertas.create') }}" style="color: green">oferta particular</a>
            <a class="dropdown-item" href="{{ route('localcomercials.create') }}" style="color: green">Local Comercial</a>
            <a class="dropdown-item" href="{{ route('lotes.create') }}" style="color: green">Lote</a>

          </div> --}}

        <a href="/ofertas/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true"><b class="fas fa-plus"></b> Añadir Oferta  </a>
    </div>
</div>

<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Duracion</th>
                <th>Costo</th>
                <th>Descripcion</th>
                <th># Publicaciones</th>
                <th>Plan</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Duracion</th>
                <th>Costo</th>
                <th>Descripcion</th>
                <th># Publicaciones</th>
                <th>Plan</th>
                <th>Tools</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($ofertas as $oferta)
                    <tr>
                        <td>{{ $oferta['id_ofertas'] }}</td>
                        <td>{{ $oferta['nombre'] }}</td>
                        <td>{{ $oferta['duracion'] }}</td>
                        <td>{{ $oferta['costo'] }}$us. <br>{{$oferta['costo']*6.90}}bs. </td>

                        <td>{{ $oferta['descripcion'] }}</td>
                        <td>{{ $oferta['numero_publicaciones'] }}</td>
                        <td> {{ $oferta->plane->nombre }}</td>

                        <td width="8%">
                            <a href="/ofertas/{{ $oferta['id_ofertas'] }}"><i class="fa fa-eye"></i></a>
                            <a href="/ofertas/{{ $oferta['id_ofertas'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-ofertaid="{{$oferta['id_ofertas']}}"><i class="fas fa-trash-alt"></i></a>
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
        <div class="modal-body">Seleccione "eliminar" si realmente desea eliminar este oferta.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            <input type="hidden" id="oferta_id" name="oferta_id" value="">
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
        </form>
        </div>
    </div>
    </div>
</div>

@section('js_oferta_page')

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var oferta_id = button.data('ofertaid')

        var modal = $(this)
        modal.find('.modal-footer #oferta_id').val(oferta_id)
        modal.find('form').attr('action','/ofertas/' + oferta_id);
    })
</script>

@endsection

@endsection
