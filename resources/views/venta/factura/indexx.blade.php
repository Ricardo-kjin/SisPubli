@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card-header">
        <div class="row">
            <div class="card card-warning">
                <div class="card-header">
                    <h2 class="card-signin">Lista de Todas las facturas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <a href="{{ route('decargarPDFFacturas') }}" target="_blank" class="btn btn-sm btn-danger">Imprimir lista de Facturas</a>
                    <a href="{{ route('decargarPDFFacturas') }}" target="_blank" class="btn btn-sm btn-success">Imprimir lista de Facturas</a>
                    {{-- <p>Correo: </p>
                    <p>Fecha de Nacimiento:</p>
                    <p>Grupo: </p> --}}
                    {{-- @if (Auth::user()->grupos->first()->nombre=='Empresa')
                        <p>NIT:  {{$userfacturas->tipousuarios->nit_empresa}}</p>
                    @else
                        <p>NIT:  {{$userfacturas->tipousuarios->nit_agente}}</p>
                    @endif --}}

                    {{-- <p>Area libre:{{$inmueble->area_libre}}</p>
                    <p>Zona:{{$inmueble->zona->nombre}}</p> --}}
                    {{-- <p>Habitaciones:{{$inmueble->habitaciones}}</p>
                    <p>Baños:{{$inmueble->baños}}</p> --}}
                    {{-- <p>Pisos:{{$inmueble->pisos}}</p>
                    <p>Garajes:{{$inmueble->garajes}}</p>
                    <p>Zona:{{$inmueble->zona->nombre}}</p>
                    <p>Tipo de inmueble:{{$inmueble->tipoinmueble->nombre}}</p> --}}
                    {{-- <p>Inmuebles asociados:
                    @if ($inmueble->proyecto)
                        @foreach ($inmueble->proyecto as $serv)
                            {{$serv->titulo}},
                        @endforeach
                    @endif
                    </p> --}}
                    {{-- <p>Servicios:
                        @foreach ($inmueble->servicios as $serv)
                            {{$serv->nombre}},
                        @endforeach
                    </p> --}}
                </div>
            </div>
            {{-- <div class="content" style="margin-top:30px">

                <img src="{{ asset('/storage/images/portada_imagen_inmueble/'.$inmueble->foto_principal)}}" width="350" alt="" style="float:left; margin-right:20px;">
                <p>Descripcion:{!!$inmueble->descripcion!!}</p>
            </div> --}}
        </div>
    </div>
    <div class="row">

				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table class="table table-striped table-bordered table-condensed table-hover" id="detalles">
						<thead style="background-color:#f38c8c">
                            <th>Cod Factura</th>
							<th>Oferta</th>
							<th>Cliente</th>
                            {{-- <th>Inicio</th>
                            <th>Final</th>
							<th>N° de publicaciones</th> --}}
							<th>Duracion</th>
							{{-- <th>Descripcion</th> --}}
                            <th>Emision</th>
							<th>Iva</th>
							<th>Costo Bruto</th>
							<th>Costo Total</th>
                            <th>Tools</th>
						</thead>
						<tfoot>
							<th></th>
							<th></th>
							{{-- <th></th>
							<th></th>
							<th></th> --}}
							<th></th>
                            <th></th>
							<th></th>
							<th></th>
							<th></th>{{-- <th><h4 id="total"><strong>{{$userfacturas->notaventas->first()->factura['costo_neto']}}</strong></h4></th> --}}
                            <th></th>
                        </tfoot>
						<tbody>
                            @foreach ($facturas as $factura)
                            <tr>
                                <td>{{$factura['num_factura']}}</td>
                                <td>{{$factura->notaventa->oferta['nombre']}}</td>
                                <td>{{$factura->notaventa->user->name}}</td>
                                <td>{{$factura->notaventa->oferta->duracion}}</td>
                                <td>{{$factura['fecha_emicion']}}</td>
                                <td>{{$factura['costo_neto']*0.13}}</td>
                                <td>{{$factura['costo_bruto']}}</td>
                                <td>{{$factura['costo_neto']}}</td>
                                <td>
                                    <a href="/facturas/{{ $factura->id_facturas }}"><i class="fa fa-eye">
                                </td>
                            </tr>
                            @endforeach

						</tbody>
					</table>
				</div>
	</div>


</div>

@endsection
