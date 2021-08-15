@extends('admin.layouts.dashboard')

@section('content')

<form method="POST" action="/notaventas" >
    {{ csrf_field() }}
    <div class="box-header with-border">
        <h3 class="box-title">Inmofertas-Sis Publicitario</h3>
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
    <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="box-header with-border">
                <h3 class="box-title">Factura</h3>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group ">
                <label for="num_factura"><b style="color: red"> Numero de Factura:</b></label>
                <p>{{$array['num_factura']}} </p>
                <input type="text" name="num_factura" class="form-control" id="num_factura" value="{{ $array['num_factura'] }}" hidden="true">
            </div>
        </div>
    </div>
    <div class="row">

		<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
			<div class="form-group">
				<label for="usuario"><b>Cliente</b></label>
				<p>{{$array['usuario']}} es usuario administrador:</p>
                <input type="text" name="usuario" class="form-control" id="usuario" value="{{ $array['usuario'] }}" hidden="true">
			</div>
		</div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="nit"><b>Cliente</b></label>
				<p>{{$array['nit']}}</p>
                <input type="text" name="nit" class="form-control" id="nit" value="{{ $array['nit'] }}" hidden="true">
			</div>
		</div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
				<label for="fecha_emicion"><b>Fecha de Emision:</b></label>
				<p> {{$array['fecha_emicion']}}</p>
                <input type="text" name="fecha_emicion" class="form-control" id="fecha_emicion" value="{{ $array['fecha_emicion'] }}" hidden="true">
			</div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
				<label for="num_comprobante"><b>Numero de Comprobante:</b></label>

                <input type="text" name="num_comprobante" class="form-control" id="num_comprobante" placeholder="# comprobante ..." value="" >
			</div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <label for="tipopago" class="container bg-warning"> <b> Seleccione la tipopago</b></label>
            <select class="grupo form-control" name="tipopago" id="tipopago">
                <option value="">Pagar con...</option>
                @foreach ($tipopagos as $tipopago)
                    <option data-tipopago-id="{{$tipopago->id_tipo_pagos}}" data-tipopago-slug="{{$tipopago->descripcion}}" value="{{$tipopago->id_tipo_pagos}}">{{$tipopago->nombre}}</option>
                @endforeach

            </select>
        </div>


    </div>
    <div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table class="table table-striped table-bordered table-condensed table-hover" id="detalles">
						<thead style="background-color:#8cc1f3">
							<th>Nombre de la Oferta</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
							<th>N° de publicaciones</th>
							<th>Duracion</th>
							<th>Descripcion</th>
							<th>Impuesto Iva</th>
							<th>Costo Bruto</th>
							<th>Costo Total</th>
						</thead>
						<tfoot>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><h4 id="total"><strong>{{$array['costo_neto']}}</strong></h4></th>
						</tfoot>
						<tbody>
								<tr>
									<td>{{$array['nombre_oferta']}}</td>
                                    <input type="text" name="nombre_oferta" class="form-control" id="nombre_oferta" value="{{ $array['nombre_oferta'] }}" hidden="true">
									<td>{{$array['fecha_inicio']}}</td>
                                    <input type="text" name="fecha_inicio" class="form-control" id="fecha_inicio" value="{{ $array['fecha_inicio'] }}" hidden="true">
									<td>{{$array['fecha_fin']}}</td>
                                    <input type="text" name="fecha_fin" class="form-control" id="fecha_fin" value="{{ $array['fecha_fin'] }}" hidden="true">
									<td>{{$array['numero_publicaciones']}}</td>
                                    <input type="text" name="numero_publicaciones" class="form-control" id="numero_publicaciones" value="{{ $array['numero_publicaciones'] }}" hidden="true">
									<td>{{$array['duracion']}}</td>
                                    <input type="text" name="duracion" class="form-control" id="duracion" value="{{ $array['duracion'] }}" hidden="true">
									<td>{{$array['descripcion']}}</td>
                                    <input type="text" name="descripcion" class="form-control" id="descripcion" value="{{ $array['descripcion'] }}" hidden="true">
									<td>{{$array['impuesto_iva']}}</td>
                                    <input type="text" name="impuesto_iva" class="form-control" id="impuesto_iva" value="{{ $array['impuesto_iva'] }}" hidden="true">
									<td>{{$array['costo_bruto']}}</td>
                                    <input type="text" name="costo_bruto" class="form-control" id="costo_bruto" value="{{ $array['costo_bruto'] }}" hidden="true">
									<td>{{$array['costo_neto']}}</td>
                                    <input type="text" name="costo_neto" class="form-control" id="costo_neto" value="{{ $array['costo_neto'] }}" hidden="true">
								</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    <div class="form-group pt-2">

        <input class="btn btn-success" type="submit" value="Grabar">
        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@endsection
