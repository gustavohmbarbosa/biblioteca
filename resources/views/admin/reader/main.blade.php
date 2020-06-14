@extends('layouts.app')

@section('content')
    <div class="content">
        <h2>Usuário</h2> 
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
                    <a class="nav-link" href="#delete">Excluir</a>
                </li>
            </ul>

            <div class="block-content block-content-full tab-content overflow-hidden">
                <!-- Perfil -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    @yield('profile')
                </div>
                <!-- Editar -->
                <div class="tab-pane fade" id="edit" role="tabpanel">
                    @yield('edit')
                </div>

                <!-- Senha -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    @yield('password')
                </div>

                <!-- excluir -->
                <div class="tab-pane fade" id="delete" role="tabpanel">
                    @yield('delete')
                </div>                               
            </div>
        </div>
    </div>
@endsection