@extends('plantillas.plantilla')
@section('cabecera')
detalles de {{$modulo->nombre}}
@endsection
@section('contenido')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $miError)
        <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Pagina</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    </head>
    <body>
        <div class='container mt-5'>
        <table class="table table-bordered table-dark ">
            
            <tbody>
                <tr>
                <th scope="row">{{$modulo->id}}</th>
                <td>{{$modulo->nombre}}</td>
                <td>{{$modulo->horas}}</td>
                <td><img src="{{asset($modulo->logo)}}" width="60px" height="60px"></td>
                <td>
                </tr>
            <br>
        </div>
    </body>
</html>
@endsection