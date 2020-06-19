@extends('layouts.app')

@section('content')
    <div class="content">
        <h2>Dados do Usuário: {{$reader->id}}</h2> 
        <hr>

        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#profile">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#edit">Editar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#password">Senha</a>
                </li>
                <li class="nav-item">
                    <form action="{{route('admin.reader.destroy', ['reader' => $reader->id])}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="nav-link danger">Excluir</button>
                    </form>
                </li>
            </ul>

            <div class="block-content block-content-full tab-content overflow-hidden">
                <!-- Perfil -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    @include('admin.reader.profile')
                </div>

                <!-- Editar -->
                <div class="tab-pane fade" id="edit" role="tabpanel">
                    @include('admin.reader.edit')
                </div>

                <!-- Senha -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    
                </div>

                 
            </div>
        </div>
    </div>
@endsection