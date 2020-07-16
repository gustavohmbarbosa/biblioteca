@extends('layouts.auth')

@section('content')

<div id="page-container" class="main-content-boxed side-trans-enabled">
    <main id="main-container" style="min-height: 608px;">
<div class="bg-image" style="background-image: url({{ asset('media/photos/photo34@2x.jpg') }});">
<div class="row mx-0 bg-earth-op">
<div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
<div class="p-30 js-appear-enabled animated fadeIn" data-toggle="appear">
    <p class="font-size-h3 font-w600 text-white mb-5">
        {{ __("É necessário ser um Administrador Master para cadastrar um novo Administrador!") }}
    </p>
    <p class="font-italic text-white-op">
       ETE - AVS © <span class="js-year-copy js-year-copy-enabled">2020</span>
    </p>
</div>
</div>
<div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white">
<div class="content content-full">
    <div class="px-30 py-10">
        <a class="link-effect font-w700" href="https://demo.pixelcave.com/codebase/index.php">
            <i class="si si-fire"></i>
            <span class="font-size-xl text-primary-dark">code</span><span class="font-size-xl">base</span>
        </a>
        <h1 class="h3 font-w700 mt-30 mb-10">{{ __('Criar uma Conta') }}</h1>
        <h2 class="h5 font-w400 text-muted mb-0">{{ __('Adicione os dados') }}</h2>
    </div>
    <form class="px-30" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="signupUsername" name="name">
                    <label for="signupUsername">{{ __('Nome do usuário') }}</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="signupEmail" name="email">
                    <label for="signupEmail">{{ __('Email') }}</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating open">
                    <select class="form-control" id="userType" name="type">
                        <option value="Comum">Comum</option>
                        <option value="Master">Master</option>
                    </select>
                    <label for="userType">Tipo de Admin</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="signupPassword" name="password">
                    <label for="signupPassword">{{ __('Senha') }}</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="password" class="form-control" id="signupPasswordConfirm" name="password_confirmation">
                    <label for="signupPasswordConfirm">{{ __('Confirmação de Senha') }}</label>
                </div>
            </div>
        </div>
        {{-- <div class="form-group row">
            <div class="col-12">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="signup-terms" name="signup-terms">
                    <label class="custom-control-label" for="signup-terms">Eu concordo com os termos e condições</label>
                </div>
            </div>
        </div> --}}
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-hero btn-alt-success">
                <i class="fa fa-plus mr-10"></i> {{ __('Criar Conta') }}
            </button>
            <div class="mt-30">
                {{-- <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="https://demo.pixelcave.com/codebase/op_auth_signup2.php#" data-toggle="modal" data-target="#modal-terms">
                    <i class="fa fa-book text-muted mr-5"></i> {{ __('Leia os Termos') }}
                </a> --}}
                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('login') }}">
                    <i class="fa fa-user text-muted mr-5"></i> Entrar
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
{{-- <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-slidedown" role="document">
<div class="modal-content">
<div class="block block-themed block-transparent mb-0">
    <div class="block-header bg-primary-dark">
        <h3 class="block-title">Terms &amp; Conditions</h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                <i class="si si-close"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
<p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
<p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-alt-success" data-dismiss="modal">
        <i class="fa fa-check"></i> Perfect
    </button>
</div>
</div>
</div>
</div> --}}

@endsection