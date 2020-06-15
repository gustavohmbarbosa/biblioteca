@extends('layouts.app')

@section('content')
<div class="content">
    <h2>Novo Livro</h2>
    <hr>
    <form action="{{route('admin.book.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="status" value="ATIVO">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Título</label>
                <input type="text" name="title" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-6">
                <label>Subtítulo</label>
                <input type="text" name="subtitle" class="form-control" autocomplete="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Origem</label>
                <select type="text" name="origin" class="form-control">
                    <option value="comprado">Comprado</option>
                    <option value="doado">Doado</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label>Preço</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            R$
                        </span>
                    </div>
                    <input type="number" class="form-control" id="example-input1-group1" name="price">
                </div>
            </div>

            <div class="form-group col-md-3">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>CDD</label>
                <input type="text" name="cdd" class="form-control" autocomplete="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Língua</label>
                <input type="text" name="language" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Nº de Páginas</label>
                <input type="number" name="pages" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Edição</label>
                <input type="number" name="edition" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Data de Publicação</label>
                <input type="date" class="form-control" name="publication_date" placeholder="d/m/Y">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Cor</label>
                <input type="text" name="color" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Capa</label>
                <input type="text" name="cape" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Editora</label>
                <input type="text" name="company" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Autor</label>
                <input type="text" name="author" class="form-control" autocomplete="">
            </div>
        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <label>Sinopse</label>
                <textarea class="form-control" id="example-textarea-input" name="synopsis" rows="6" placeholder="Sinopse..."></textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Observações</label>
                <textarea class="form-control" id="example-textarea-input" name="observations" rows="6" placeholder="Observações..."></textarea>
            </div>
        </div>

        <div class="form-group float-right">
            <button type="submit" class="btn btn-info btn-lg btn-noborder">Concluir</button>
        </div>
    </form>
</div>
<script>$('input.date').flatpickr();</script>
@endsection