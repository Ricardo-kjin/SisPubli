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
</head>
<body>
    <header>
        <br>
        <p><strong>SIStTEMA PUBLICITARIO-SA</strong></p>
    </header>
    <main>
        <div class="container">
            <h5 style="text-align: center"><strong>Lista de Facturas</strong></h5>
            {{-- <table class="table table-striped text-center"> --}}
            <table id="example1"class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nº Factura</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Duracion</th>
                        <th scope="col">Fecha emision</th>
                        <th scope="col">IVA</th>
                        <th scope="col">Costo Bruto</th>
                        <th scope="col">Costo NETO</th>
                    </tr>
                </thead>
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

                            </tr>
                @endforeach
                </tbody>
            </table>
            <h6 style="text-align: right">Fecha impresion: {{$fechas}}</h6>
        </div>
    </main>
    <footer>
        <p><strong>UN GUSTO CONTAR CON USTED!</strong></p>
    </footer>
</body>
</html>
