@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card-header">
        <div class="row">
            <div class="card card-warning">
                <div class="card-header">
                    <h2 class="card-signin">{{$userfacturas->name}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <p>Correo: {{$userfacturas->email}}</p>
                    <p>Fecha de Nacimiento: {{$userfacturas->fecha_nac}}</p>
                    <p>Grupo:  {{$userfacturas->grupos->first()->nombre}}</p>
                    @if (Auth::user()->grupos->first()->nombre=='Empresa')
                        <p>NIT:  {{$userfacturas->tipousuarios->nit_empresa}}</p>
                    @else
                        <p>NIT:  {{$userfacturas->tipousuarios->nit_agente}}</p>
                    @endif

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
                            @foreach ($userfacturas->notaventas as $venta)
                            <tr>
                                <td>{{$venta->factura['num_factura']}}</td>
                                <td>{{$venta->oferta['nombre']}}</td>
                                {{-- <input type="text" name="nombre_oferta" class="form-control" id="nombre_oferta" value="{{ $array['nombre_oferta'] }}" hidden="true"> --}}
                                {{-- <td>{{$venta['fecha_inicio']}}</td> --}}
                                {{-- <input type="text" name="fecha_inicio" class="form-control" id="fecha_inicio" value="{{ $venta['fecha_inicio'] }}" hidden="true"> --}}
                                {{-- <td>{{$venta['fecha_final']}}</td> --}}
                                {{-- <input type="text" name="fecha_fin" class="form-control" id="fecha_fin" value="{{ $venta['fecha_fin'] }}" hidden="true"> --}}
                                {{-- <td><center>{{$venta->oferta['numero_publicaciones']}}</center></td> --}}
                                {{-- <input type="text" name="numero_publicaciones" class="form-control" id="numero_publicaciones" value="{{ $venta['numero_publicaciones'] }}" hidden="true"> --}}
                                <td>{{$venta->oferta->duracion}}</td>
                                {{-- <input type="text" name="duracion" class="form-control" id="duracion" value="{{ $venta['duracion'] }}" hidden="true"> --}}
                                {{-- <td>{{$venta->oferta['descripcion']}}</td> --}}
                                <td>{{$venta->factura['fecha_emicion']}}</td>
                                {{-- <input type="text" name="descripcion" class="form-control" id="descripcion" value="{{ $venta['descripcion'] }}" hidden="true"> --}}
                                <td>{{$venta->factura['costo_neto']*0.13}}</td>
                                {{-- <input type="text" name="impuesto_iva" class="form-control" id="impuesto_iva" value="{{ $venta['impuesto_iva'] }}" hidden="true"> --}}
                                <td>{{$venta->factura['costo_bruto']}}</td>
                                {{-- <input type="text" name="costo_bruto" class="form-control" id="costo_bruto" value="{{ $venta['costo_bruto'] }}" hidden="true"> --}}
                                <td>{{$venta->factura['costo_neto']}}</td>
                                {{-- <input type="text" name="costo_neto" class="form-control" id="costo_neto" value="{{ $array['costo_neto'] }}" hidden="true"> --}}
                                <td>
                                    <a href="/facturas/{{ $venta->factura->id_facturas }}"><i class="fa fa-eye">
                                </td>
                            </tr>
                            @endforeach

						</tbody>
					</table>
				</div>
	</div>

    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>

</div>

@endsection
