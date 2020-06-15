@extends('layouts.app')

@section('content')
<div class="content">
    <h2>Editar Dados do Livro #{{$book->id}}</h2>
    <hr>
    <form action="{{route('admin.book.update', [$book->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <input type="hidden" name="status" value="ATIVO">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Título</label>
                <input type="text" name="title" class="form-control" value="{{ $book->title }}" autocomplete="">
            </div>
            <div class="form-group col-md-6">
                <label>Subtítulo</label>
                <input type="text" name="subtitle" class="form-control" value="{{ $book->subtitle }}" autocomplete="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Origem</label>
                <select type="text" name="origin" class="form-control">
                    <option value="comprado" @if($book == "comprado") selected @endif>Comprado</option>
                    <option value="doado" @if($book == "doado") selected @endif>Doado</option>
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
                    <input type="number" class="form-control" id="example-input1-group1"  value="{{ number_format($book->price, 2, '.', ',') }}" name="price">
                </div>
            </div>

            <div class="form-group col-md-3">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>CDD</label>
                <input type="text" name="cdd" class="form-control" value="{{ $book->cdd }}" autocomplete="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Língua</label>
                <input type="text" name="language" class="form-control" value="{{ $book->language }}" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Nº de Páginas</label>
                <input type="number" name="pages" class="form-control" value="{{ $book->pages }}" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Edição</label>
                <input type="number" name="edition" class="form-control" value="{{ $book->edition }}" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Data de Publicação</label>
                <input type="date" class="form-control" name="publication_date" value="{{ $book->publication_date }}" placeholder="d/m/Y">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Cor</label>
                <input type="text" name="color" class="form-control" value="{{ $book->color }}" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Capa</label>
                <input type="text" name="cape" class="form-control" value="{{ $book->cape }}" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Editora</label>
                <input type="text" name="company" class="form-control" value="{{ $book->edition }}" autocomplete="">
            </div>
            <div class="form-group col-md-3">
                <label>Autor</label>
                <input type="text" name="author" class="form-control" value="{{ $book->author }}" autocomplete="">
            </div>
        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <label>Sinopse</label>
                <textarea class="form-control" id="example-textarea-input" name="synopsis" rows="6" placeholder="Sinopse...">{{ $book->synopsis }}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Observações</label>
                <textarea class="form-control" id="example-textarea-input" name="observations" rows="6" placeholder="Observações...">{{ $book->observations }}</textarea>
            </div>
        </div>

        <div class="form-group float-right">
            <button type="submit" class="btn btn-info btn-lg btn-noborder">Concluir</button>
        </div>
    </form>
</div>
@endsection