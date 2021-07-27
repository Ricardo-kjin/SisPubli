@extends('admin.layouts.dashboard')
@section('content')

<h1>Create new Grupo</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/grupos">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nombre_grupo">Nombre del Grupo:</label>
        <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" placeholder="Nombre del grupo..." value="{{ old('nombre_grupo') }}" >
    </div>
    <div class="form-group">
        <label for="descripcion">Descipcion</label>
        <input type="text" name="descripcion" tag="descripcion" class="form-control" id="descripcion" placeholder="Descipcion..." value="{{ old('descripcion') }}" >
    </div>

    <label for="acceso"> <b> Seleccione los Accesos</b></label>
    <div class="row">
    @foreach ($accesos as $acceso)
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group" >

                {{-- <input type="text" data-role="tagsinput" name="accesos_grupos" class="form-control" id="accesos_grupos" value="{{ old('accesos_grupos') }}"> --}}
                <input type="checkbox" name="acceso[]" id="{{$acceso->descripcion}}" value="{{$acceso->id_accesos}}" >
                <label for="{{$acceso->descripcion}}">{{$acceso->nombre}}</label>
            </div>
        </div>
        @endforeach
    </div>

        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Submit">
        </div>
</form>

@section('css_grupo_page')
    <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css">
@endsection

@section('js_grupo_page')
    <script src="/js/admin/bootstrap-tagsinput.js"></script>

    {{-- <script>
        $(document).ready(function(){
            $('#role_name').keyup(function(e){
                var str = $('#role_name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                $('#role_slug').val(str);
                $('#role_slug').attr('placeholder', str);
            });
        });

    </script> --}}

@endsection
@endsection
