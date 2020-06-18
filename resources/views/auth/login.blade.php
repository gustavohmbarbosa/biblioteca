@extends('layouts.auth')

@section('content')

<div id="page-container" class="main-content-boxed side-trans-enabled">
    <main id="main-container" style="min-height: 608px;">
<div class="bg-image" style="background-image: url({{ asset('media/photos/photo26@2x.jpg') }});">
<div class="row mx-0 bg-black-op">
<div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
<div class="p-30 js-appear-enabled animated fadeIn" data-toggle="appear">
    <blockquote class="blockquote mb-4  ">
        <p class="font-size-h3 font-w600 text-white m-0">
            <em>"A leitura engrandece a alma."</em>
        </p>
        <footer class="blockquote-footer text-white">
            <em>Voltaire</em>
        </footer>
    </blockquote>
    <p class="font-italic text-white-op">
        ETE - AVS © <span class="js-year-copy js-year-copy-enabled">2020</span>
    </p>
</div>
</div>
<div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white js-appear-enabled animated fadeInRight" data-toggle="appear" data-class="animated fadeInRight">
<div class="content content-full">
    <div class="px-30 py-10">
        <a class="link-effect font-w700" href="https://demo.pixelcave.com/codebase/index.php">
            <i class="si si-fire"></i>
            <span class="font-size-xl text-primary-dark">code</span><span class="font-size-xl">base</span>
        </a>
        <h1 class="h3 font-w700 mt-30 mb-10">Bem Vindo à Biblioteca</h1>
        <h2 class="h5 font-w400 text-muted mb-0">Efetue o login.</h2>
    </div>
    <form class="px-30" action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="email" class="form-control valid @error('email') is-invalid @enderror" id="loginEmail" name="email">
                    <label for="login-username">{{ __('Usuário') }}</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="password" class="form-control valid @error('password') is-invalid @enderror" id="loginPassword" name="password">
                    <label for="login-password">{{ __('Senha') }}</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                <i class="si si-login mr-10"></i> {{ __('Entrar')}}
            </button>
            <div class="mt-30">
                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('register') }}">
                    <i class="fa fa-plus mr-5"></i> {{ __('Criar Conta')}}
                </a>
                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('password.request') }}">
                    <i class="fa fa-warning mr-5"></i> {{ __('Esqueci minha senha')}}
                </a>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</main>
</div>

@endsection