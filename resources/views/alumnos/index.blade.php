@extends('plantillas.plantilla')
@section('titulo')
    Academia s.a
@endsection
@section('cabecera')
    Gestion de alumnos
@endsection
@section('contenido')
@if ($texto=Session::get('mensaje'))
<p class="alert alert-success my-3">{{$texto}}</p>    
@endif
<a href="{{route('alumnos.create')}}" class="btn btn-info " ><i class="fa fa-plus"></i> Crear alumno</a>
<form name="buscar" method="GET" action="{{route('alumnos.index')}}" class="form-inline float-right">
 <label>Modulos</label>
  <select name="modulos" class="form-control mr-2 float-left">
    <option value="%">Todos</option>
    @foreach($modulos as $modulo)
    <option>{{$modulo->nombre}}</option>
    @endforeach
  </select>
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
<table class="table table-dark mt-3">
        <thead>
          <tr>
            <th scope="col" class="align-middle">Detalles</th>
            <th scope="col" class="align-middle">Apellidos, Nombre</th>
            <th scope="col" class="align-middle">Mail</th>
            <th scope="col" class="align-middle">Imagen</th>
            <th scope="col" class="align-middle">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
            <tr>
            <th scope="row">
                <a href="{{route('alumnos.show', $alumno)}}" style="text-decoration:none"><i class="fa-2x fa fa-address-card"></i></a>
            </th>
            <td class="align-middle">{{$alumno->nombre.", ".$alumno->apellido}}</td>
            <td class="align-middle">{{$alumno->mail}}</td>
                <td class="align-middle">
                <img src="{{asset($alumno->logo)}}" width="90px" height="90px" class="rounded-circle">
                </td>
                <td class="align-middle">
                <form class="form-inline" action="{{route('alumnos.destroy', $alumno)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Desea borrar Alumno?')" class="fa fa-trash btn btn-danger"></button>
                <a href="{{route('alumnos.edit', $alumno)}}" class="ml-2 fa fa-edit fa-2x"></a>
                </form>
                </td>
            </tr>
            @endforeach
          
          
        </tbody>
      </table>
      {{$alumnos->links()}}
@endsection