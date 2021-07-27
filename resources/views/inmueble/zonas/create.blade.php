@extends('admin.layouts.dashboard')
@section('content')

<h1>Nueva zona</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/zonas">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nombre">Nombre del zona:</label>
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del zona..." value="{{ old('nombre') }}" >
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion:</label>
        <input type="text" name="descripcion" tag="descripcion" class="form-control" id="descripcion" placeholder="Descipcion..." value="{{ old('descripcion') }}" >
    </div>
    <div class="form-group">
        <label for="url">Url:</label>
        <input type="text" name="url" tag="url" class="form-control" id="url" placeholder="Descipcion..." value="{{ old('url') }}" >
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>

@endsection
