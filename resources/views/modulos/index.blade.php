@extends('plantillas.plantilla')
@section('titulo')
Modulos
@endsection
@section('cabecera')
Index modulos
@endsection
@section('contenido')
@if($texto = Session::get('mensaje'))
    <p class="alert alert-success my-3">{{$texto}}</p>
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
        <div class='container mt-5 mb-5'>
        <a href="{{route('modulos.create')}}">Crear Modulo</a>
        <table class="table table-bordered table-dark ">
            <thead>
                <tr>
                <th scope="col">Detalles</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Horas</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($modulos as $modulo)
                <tr>
                <td><a href="{{route('modulos.show',$modulo)}}" class="btn btn-info"></td>
                <th scope="row">{{$modulo->id}}</th>
                <td>{{$modulo->nombre}}</td>
                <td>{{$modulo->horas}}</td>
                <td><img src="{{asset($modulo->logo)}}" width="60px" height="60px"></td>
                <td>
                    <form method="POST" action="{{route('modulos.destroy',$modulo)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('¿Desea borrarlo?')" class="btn btn-danger">Borrar</button>
                        <a href="{{route('modulos.edit',$modulo)}}" class="btn btn-info">Editar</a>
                    </form>
                </td>
                </tr>
            @endforeach
            </tbody>
            </table>
            <a href="{{route('alumnos.index')}}" class="btn btn-info">Ir a Alumnos</a>
            <br>
            {{$modulos->links()}}
            <br>
        </div>
    </body>
</html>
@endsection