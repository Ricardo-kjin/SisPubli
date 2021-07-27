@extends('admin.layouts.dashboard')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de los tipos de publicacions</h2>
    </div>
    <div class="col-md-6">
        <a href="/tipopublicacions/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true"><b class="fas fa-plus"></b> Agregar Tipo  </a>
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
                <th>tipopublicacion</th>
                <th>Descripcion</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>tipopublicacion</th>
                <th>Descripcion</th>
                <th>Tools</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($tipopublicacions as $tipopublicacion)
                    <tr>
                        <td>{{ $tipopublicacion['id'] }}</td>
                        <td>{{ $tipopublicacion['nombre'] }}</td>
                        <td>{{ $tipopublicacion['descripcion'] }}</td>

                        <td width="8%">
                            <a href="/tipopublicacions/{{ $tipopublicacion['id'] }}"><i class="fa fa-eye"></i></a>
                            <a href="/tipopublicacions/{{ $tipopublicacion['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-tipopublicacionid="{{$tipopublicacion['id']}}"><i class="fas fa-trash-alt"></i></a>
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
        <div class="modal-body">Seleccione "eliminar" si realmente desea eliminar este tipopublicacion.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            <input type="hidden" id="tipopublicacion_id" name="tipopublicacion_id" value="">
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
        </form>
        </div>
    </div>
    </div>
</div>

@section('js_tipopublicacion_page')

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var tipopublicacion_id = button.data('tipopublicacionid')

        var modal = $(this)
        modal.find('.modal-footer #tipopublicacion_id').val(tipopublicacion_id)
        modal.find('form').attr('action','/tipopublicacions/' + tipopublicacion_id);
    })
</script>

@endsection

@endsection
