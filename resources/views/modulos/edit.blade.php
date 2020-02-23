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
        <form method="POST" action="{{route('modulos.update',$modulo)}}" enctype="multipart/form-data">
        @method('PUT')
           @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{$modulo->nombre}}"placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nº de Horas</label>
                <select class="form-control" name="horas">
                @if($modulo->horas == 1)
                <option selected>1</option>
                @else
                <option>1</option>
                @endif
                @if($modulo->horas == 2)
                <option selected>2</option>
                @else
                <option>2</option>
                @endif
                @if($modulo->horas == 3)
                <option selected>3</option>
                @else
                <option>3</option>
                @endif
                @if($modulo->horas == 4)
                <option selected>4</option>
                @else
                <option>4</option>
                @endif
                @if($modulo->horas == 5)
                <option selected>5</option>
                @else
                <option>5</option>
                @endif
                @if($modulo->horas == 6)
                <option selected>6</option>
                @else
                <option>6</option>
                @endif
                @if($modulo->horas == 7)
                <option selected>7</option>
                @else
                <option>7</option>
                @endif
                @if($modulo->horas == 8)
                <option selected>8</option>
                @else
                <option>8</option>
                @endif
                @if($modulo->horas == 9)
                <option selected>9</option>
                @else
                <option>9</option>
                @endif
                @if($modulo->horas == 10)
                <option selected>10</option>
                @else
                <option>10</option>
                @endif
                </select>
            </div>
            <div class="col">
                <img src="{{asset($modulo->logo)}}" width="50px" height="50px"><br>
                     <label for="nom" class="col-form-label">Imagen</label>
                    <input type="file" class="form-control"  name="logo"  >
             </div><br>
            <input type="submit" value="Modificar" class="btn btn-success mr-3">
            <a href="{{route('modulos.index')}}" type="submit" class="btn btn-info">Volver</a>
            </form>
            <br>
        </div>
    </body>
</html>
@endsection