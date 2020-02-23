@extends('plantillas.plantilla')
@section('titulo')
    Academia s.a
@endsection
@section('cabecera')
    Editar {{$alumno->nombre}}, {{$alumno->apellido}}
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

<div class="card bg-secondary">
    <div class="card-header text-center ">Guardar Alumno</div>
    <div class="card-body">
    <form action="{{route('alumnos.update', $alumno)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-row">
        <div class="col">
            <label for="nom" class="col-form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{$alumno->nombre}}" id="nom" required>
        </div>
        <div class="col">
                <label for="nom" class="col-form-label">Apellidos</label>
        <input type="text" name="apellido" class="form-control"  value="{{$alumno->apellido}}" id="ape" required>
            </div>
    </div>
   

        <div class="form-row">
                <div class="col">
                    <label for="nom" class="col-form-label">E-Mail</label>
                <input type="mail" name="mail" class="form-control"  value="{{$alumno->mail}}" id="mail" required>
                </div>
                <div class="col">
                        <label for="nom" class="col-form-label">Cambiar logo</label>
                        <input type="file" class="form-control"  name="logo"  id="imagen" >
                </div>
                <div class="col">
                        <label for="nom" class="col-form-label">logo:</label>
                    <img src="{{asset($alumno->logo)}}" width="90px" height="90px" class="rounded-circle">
            </div>
            </div>
            <div class="form-row mt-3">
                <input type="submit" value="Modificar" class="btn btn-success mr-3">
                <input type="reset" value="Limpiar" class="btn btn-danger mr-3">
            <a href="{{route('alumnos.index')}}" class="btn btn-info" >Volver</a>
                    
            </div>
    </form>

    </div>

</div>

@endsection