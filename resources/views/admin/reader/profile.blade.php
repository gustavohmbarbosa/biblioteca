@extends('layouts.app')

@section('content')
    <div class="content">
        <h2>Usuário #{{$reader->id}}</h2>
        <hr>

        <h2>Nome: {{$reader->name}}</h2>
        <p>Email: {{$reader->email}}</p>
        <p>Telefone: {{$reader->phone}}</p>
        <p>Sexo: {{$reader->gender}}</p>
        <p>Série: {{$reader->year}}</p>
        <p>Turma: {{$reader->class}}</p>
        <p>Curso: {{$reader->course}}</p>
        <p>Matrícula: {{$reader->registration}}</p>
        <span class="badge {{$reader->status == 'ATIVO' ?  'badge-success' : 'badge-danger'}}">{{$reader->status}}</span>
    </div>
@endsection