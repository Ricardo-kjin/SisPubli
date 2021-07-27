@extends('admin.layouts.dashboard')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de Usuarios</h2>
    </div>
    <div class="col-md-6">

            <a class="nav-link dropdown-toggle float-md-right" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="btn btn-success">Agregar Usuario </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">

              <a class="dropdown-item" href="{{ route('users.create') }}" style="color: green">Particular</a>
              <a class="dropdown-item" href="{{ route('agentes.create') }}" style="color: green">Agente</a>
              <a class="dropdown-item" href="{{ route('empresas.create') }}" style="color: green">Empresa</a>

            </div>

        <!--a href="/users/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true">Crear Nuevo Usuario</a-->
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
                <th>Name</th>
                <th>Email</th>
                <th>Tipo de Usuario</th>
                <th>Grupo</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tipo de Usuario</th>
                <th>Grupo</th>
                <th>Tools</th>
            </tr>
            </tfoot>
            <tbody>
                {{--@if(!\Auth::user()->hasRole('admin') && $user->hasRole('admin')) @continue; @endif--}}
                {{--<tr {{ Auth::user()->id == $user->id ? 'bgcolor=#ddd' : '' }}>--}}
                @foreach ($usuarios as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}} </td>
                    @if ($user->tipousuarios->nit_agente=="ND")
                        @if ($user->tipousuarios->nit_empresa=="ND")
                            <td>Particular</td>
                        @else
                            <td>Empresa</td>
                        @endif

                    @else
                        <td>Agente</td>
                    @endif
                    <td>
                        @if (isset($user->grupos))
                            @foreach ($user->grupos as $grupo)
                            <span class="badge badge-info">
                                {{ $grupo->nombre }}
                            </span>
                            @endforeach
                        @endif
                    <td>
                        <a href="/users/{{ $user->id }}"><i class="fa fa-eye" ></i></a>
                        <a href="/users/{{ $user->id }}/edit"><i class="fa fa-edit" style="color: yellow"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$user->id}}"><i class="success fas fa-trash-alt" style="color: red"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
        <div class="modal-body">Seleccione "eliminar" si realmente desea eliminar este usuario.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            <input type="hidden" id="user_id" name="user_id" value="">
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
        </form>
        </div>
    </div>
    </div>
</div>

    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

@section('js_user_page')

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('userid')

            var modal = $(this)
            modal.find('.modal-footer #user_id').val(user_id)
            modal.find('form').attr('action','/users/' + user_id);
        })
    </script>

@endsection

@endsection
