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
            <h5 style="text-align: center"><strong>Lista de Publicaciones de {{Auth::user()->name}}</strong></h5>
            {{-- <table class="table table-striped text-center"> --}}
            <table id="example1"class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nº</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Duracion</th>
                        <th scope="col">Tipo de Publicacion</th>
                        <th scope="col">Nombre del inmueble</th>

                    </tr>
                </thead>
               <tbody>
                @foreach ($publicacions as $publicacion)
                    <tr>
                        <td>{{$publicacion['id']}}</td>
                        <td>{{ $publicacion['titulo']}}</td>
                        <td>{{ $publicacion['precio'] }} $us</td>
                        @if ($publicacion->periodo)
                            <td>{{$publicacion->periodo}}</td>
                        @else
                            <td>En venta</td>
                        @endif
                        <td>{{ $publicacion->tipopublicacion->nombre }} </td>
                        <td>{{ $publicacion->inmueble->titulo }} </td>
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
