@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card-header">
        <div class="row">
            <div class="card card-warning">
                <div class="card-header">
                    <h2 class="card-signin">Detalle de Factura</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> --}}
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align=right>
                    <div class="form-group">
                        <span><b>Nº FACTURA:</b>{{$factura->num_factura}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <span><b>Forma de Pago:</b>{{$factura->tipopago->nombre}}</span>
                    </div>
                </div>
                @if (Auth::user()->grupos->first()->nombre=='Empresa')
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <span><b>NIT:</b>{{$factura->notaventa->user->tipousuarios->nit_empresa}}</span>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <span><b>NIT:</b>{{$factura->notaventa->user->tipousuarios->nit_agente}}</span>
                        </div>
                    </div>
                @endif

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <span><b>Fecha Emision:</b>{{$factura->fecha_emicion}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <span><b>Tipo Socio:</b>{{$factura->notaventa->user->grupos->first()->nombre}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <span><b>Socio:</b>{{$factura->notaventa->user->name}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <span><b>Nº Comprobante:</b>{{$factura->num_comprobante}}</span>
                    </div>
                </div>

            {{-- </div> --}}
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
                    <th> Nº(Oferta)</th>
                    <th>Oferta</th>
                    {{-- <th>Inicio</th>
                    <th>Final</th>
                    <th>N° de publicaciones</th> --}}
                    <th>Duracion</th>
                    {{-- <th>Descripcion</th> --}}
                    <th>Expiracion</th>
                    <th>Iva</th>
                    <th>Costo Bruto</th>
                    <th>Costo Total</th>
                    {{-- <th>Tools</th> --}}
                </thead>
                <tfoot>
                    <th></th>
                    <th></th>

                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>{{-- <th><h4 id="total"><strong>{{$factura->notaventas->first()->factura['costo_neto']}}</strong></h4></th> --}}
                    {{-- <th></th> --}}
                </tfoot>
                <tbody>

                    <tr>
                        <td>{{$factura->notaventa->oferta->plane->nombre}}</td>
                        <td>{{$factura->notaventa->oferta->nombre}}</td>
                        {{-- <input type="text" name="nombre_oferta" class="form-control" id="nombre_oferta" value="{{ $array['nombre_oferta'] }}" hidden="true"> --}}
                        {{-- <td>{{$venta['fecha_inicio']}}</td> --}}
                        {{-- <input type="text" name="fecha_inicio" class="form-control" id="fecha_inicio" value="{{ $venta['fecha_inicio'] }}" hidden="true"> --}}
                        {{-- <td>{{$factura->notaventa->fecha_final}}</td> --}}
                        {{-- <input type="text" name="fecha_fin" class="form-control" id="fecha_fin" value="{{ $venta['fecha_fin'] }}" hidden="true"> --}}
                        {{-- <td><center>{{$venta->oferta['numero_publicaciones']}}</center></td> --}}
                        {{-- <input type="text" name="numero_publicaciones" class="form-control" id="numero_publicaciones" value="{{ $venta['numero_publicaciones'] }}" hidden="true"> --}}
                        <td><center>{{$factura->notaventa->oferta->duracion}} días</center></td>
                        {{-- <input type="text" name="duracion" class="form-control" id="duracion" value="{{ $venta['duracion'] }}" hidden="true"> --}}
                        <td>{{$factura->notaventa->fecha_final}}</td>
                        <td><center>{{$factura->notaventa->oferta->costo * 0.13}}</center></td>
                        {{-- <input type="text" name="descripcion" class="form-control" id="descripcion" value="{{ $venta['descripcion'] }}" hidden="true"> --}}
                        <td><center>{{$factura->notaventa->oferta->costo * 0.87}}</center></td>
                        {{-- <input type="text" name="impuesto_iva" class="form-control" id="impuesto_iva" value="{{ $venta['impuesto_iva'] }}" hidden="true"> --}}
                        <td><center>{{$factura->notaventa->oferta->costo}}</center></td>
                        {{-- <input type="text" name="costo_bruto" class="form-control" id="costo_bruto" value="{{ $venta['costo_bruto'] }}" hidden="true"> --}}
                        {{-- <td>------</td> --}}
                        {{-- <input type="text" name="costo_neto" class="form-control" id="costo_neto" value="{{ $array['costo_neto'] }}" hidden="true"> --}}
                        {{-- <td> --}}
                            {{-- <a href="/facturas/{{ $venta->factura->id_facturas }}"><i class="fa fa-eye"> --}}
                        {{-- </td> --}}
                    </tr>
                </tbody>
            </table>
        </div>
	</div>

    <div class="card-footer">
        <a href="{{url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>

</div>

@endsection
