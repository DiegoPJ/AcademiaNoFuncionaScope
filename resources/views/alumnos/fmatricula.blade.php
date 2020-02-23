@extends('plantillas.plantilla')
@section('titulo')
    Academia s.a.
@endsection
@section('cabecera')
    Módulos Disponibles para el alumno {{$alumno->nombre.', '.$alumno->apellido}}
@endsection
@section('contenido')
<form name="matricula" method="POST" action="{{route('alumnos.matricular')}}">
    @csrf
    <input type="hidden" value="{{$alumno->id}}" name="alumno_id">
    <div class="form-row">
        <select class="form-control" name="modulo_id[]" multiple>
            @foreach ($modulos2 as $modulo)
                <option value="{{$modulo->id}}">{{$modulo->nombre.'('.$modulo->horas.')'}}</option>
            @endforeach
        </select> 
    </div>
    <div class="form-row">
        <div class="col">
            <input type="submit" value="Matricula" class="btn btn-info mr-3">
            <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-primary">Volver</a>
        </div>
        
    </div>
    
</form>
@endsection