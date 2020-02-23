@extends('plantillas.plantilla')
@section('titulo')
    Academia s.a
@endsection
@section('cabecera')
    Academia S.A
@endsection
@section('contenido')
    <div class="txt-center mt-3">
    <a href="{{route('alumnos.index')}}" class="btn btn-primary mr-4"> Gestionar Alumnos</a>
    <a href="{{route('modulos.index')}}" class="btn btn-primary mr-4"> Gestionar Módulos</a>
    <br><br><br>
    
    <h1>Tarea V Relaciones (N:M)</h1><br><hr>
    <ol>
    <li>Terminaremos la práctica academia con el <b>crud de la tabla módulos</b></li><br>
    <li>Añadiremos  algún "scope" para Alumnos por ejemplo donde podamos buscar Alumnos de un determinado módulo</li><br>
    <li>Añadiremos algún scope para la tabla módulos por ejemplo para buscar alumos de un determinado módulo</li><br>
    <li>Subiremos el enlace a github del proyecyo academia</li><br><br><br>
    </ol>
    </div>
@endsection