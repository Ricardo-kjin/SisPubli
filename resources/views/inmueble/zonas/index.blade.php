@extends('admin.layouts.dashboard')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de Zonas</h2>
    </div>
    <div class="col-md-6">
        <a href="/zonas/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true"><b class="fas fa-plus"></b> Agregar Zona  </a>
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
                <th>Descripcion</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Tools</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($zonas as $zona)
                    <tr>
                        <td>{{ $zona['id'] }}</td>
                        <td>{{ $zona['nombre'] }}</td>
                        <td>{{ $zona['descripcion'] }}</td>

                        <td>
                            <a href="/zonas/{{ $zona['id'] }}"><i class="fa fa-eye"></i></a>
                            <a href="/zonas/{{ $zona['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-zonaid="{{$zona['id']}}"><i class="fas fa-trash-alt"></i></a>
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
        <div class="modal-body">Seleccione "eliminar" si realmente desea eliminar este zona.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            <input type="hidden" id="zona_id" name="zona_id" value="">
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
        </form>
        </div>
    </div>
    </div>
</div>

@section('js_zona_page')

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var zona_id = button.data('zonaid')

        var modal = $(this)
        modal.find('.modal-footer #zona_id').val(zona_id)
        modal.find('form').attr('action','/zonas/' + zona_id);
    })
</script>

@endsection

@endsection
