@extends('plantillas.plantilla')
@section('cabecera')
Crear Modulo
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
        <form method="POST" action="{{route('modulos.store')}}" enctype="multipart/form-data">
           @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nº de Horas</label>
                <select class="form-control" name="horas">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                </select>
            </div>
            <div class="col">
                     <label for="nom" class="col-form-label">Imagen</label>
                    <input type="file" class="form-control"  name="logo"  >
             </div>
            <input type="submit" value="Crear" class="btn btn-success mr-3">
            <a href="{{route('modulos.index')}}" type="submit" class="btn btn-info">Volver</a>
            </form>
            <br>
        </div>
    </body>
</html>
@endsection