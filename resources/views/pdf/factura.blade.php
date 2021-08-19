<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Facturas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em;
        }
        body {
            margin: 3cm 1cm 2cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 30px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 35px;
        }
        .table{
            width:100%;
            border:1px solid #7e7da5;
        }
    </style>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <header>
        <br>
        <p><strong>SISTEMA PUBLICITARIO-SA</strong></p>
    </header>
    <main>
            <h5 style="text-align: left"><strong>Detalle de Factura</strong></h5>
            <h5 style="text-align: left" ><strong style="color: rgb(182, 38, 38)">Factura</strong></h5>
            {{-- <table class="table table-striped text-center"> --}}


                        <p align=right><b>Nº FACTURA:</b>{{$factura->num_factura}}</p>
                        <p><b>Forma de Pago:</b>{{$factura->tipopago->nombre}}</p>
                @if ($factura->notaventa->user->grupos->first()->nombre=='Empresa')
                            <p><b>NIT:</b>{{$factura->notaventa->user->tipousuarios->nit_empresa}}</p>
                @else
                            <p><b>NIT:</b>{{$factura->notaventa->user->tipousuarios->nit_agente}}</p>
                @endif
                        {{-- <p><b>Fecha Emision:</b>{{$factura->fecha_emicion}}</p> --}}

                        <p><b>Tipo Socio:</b>{{$factura->notaventa->user->grupos->first()->nombre}}</p>

                        <p><b>Socio:</b>{{$factura->notaventa->user->name}}</p>

                        <p><b>Nº Comprobante:</b>{{$factura->num_comprobante}}</p>


            <table id="example1"class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
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
                    </tr>
                </thead>
               <tbody>
                <tr>
                    <td>{{$factura->notaventa->oferta->plane->nombre}}</td>
                    <td>{{$factura->notaventa->oferta->nombre}}</td>
                    <td><center>{{$factura->notaventa->oferta->duracion}} días</center></td>
                    <td>{{$factura->notaventa->fecha_final}}</td>
                    <td><center>{{$factura->notaventa->oferta->costo * 0.13}}</center></td>
                    <td><center>{{$factura->notaventa->oferta->costo * 0.87}}</center></td>
                    <td><center>{{$factura->notaventa->oferta->costo}}</center></td>
                </tr>
                </tbody>
            </table>

                <h5 style="text-align: left"><strong>Detalle de La Nota de Venta</strong></h5>
                <h5 style="text-align: left" ><strong style="color: rgb(182, 38, 38)">{{$factura->notaventa->oferta->nombre}}</strong></h5>
            <table id="example1"class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Tipo de <br> Publicacion</th>
                        <th>Duracion</th>
                        <th>fecha inicio</th>
                        <th>fecha de conclusion</th>
                        <th>nombre de inmueble</th>
                        <th>Precio ($us)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factura->notaventa->publicacions as $publicacion)
                        <tr>
                            <td>{{$publicacion->tipopublicacion->nombre}}</td>
                            <td>{{$publicacion->notaventa->oferta->duracion}} dias</td>
                            <td>{{$publicacion->fecha_inicio}}</td>
                            <td>{{$publicacion->fecha_fin}}</td>
                            <td>{{$publicacion->inmueble->titulo}}</td>
                            <td>{{$publicacion['precio']}}</td>
                            {{-- <td>{{$publicacion['costo_neto']*0.13}}</td>
                            <td>{{$publicacion['costo_bruto']}}</td>
                            <td>{{$publicacion['costo_neto']}}</td> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h6 style="text-align: right">Fecha impresion: {{$fechas}}</h6>

    </main>
    <footer>
        <p><strong>UN GUSTO CONTAR CON USTED!</strong></p>
    </footer>
</body>
</html>
