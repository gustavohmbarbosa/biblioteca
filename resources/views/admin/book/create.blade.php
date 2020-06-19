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
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" autocomplete="">
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label>Subtítulo</label>
                <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{old('subtitle')}}" autocomplete="">
                @error('subtitle')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Origem</label>
                <select type="text" name="origin" class="form-control @error('origin') is-invalid @enderror">
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
                    <input type="number" id="example-input1-group1" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
                </div>
                @error('price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{old('isbn')}}" autocomplete="">
                @error('isbn')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label>CDD</label>
                <input type="text" name="cdd" class="form-control @error('cdd') is-invalid @enderror" value="{{old('cdd')}}" autocomplete="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Língua</label>
                <input type="text" name="language" class="form-control @error('language') is-invalid @enderror" value="{{old('language')}}" autocomplete="">
            </div>

            <div class="form-group col-md-3">
                <label>Nº de Páginas</label>
                <input type="number" name="pages" class="form-control @error('pages') is-invalid @enderror" value="{{old('pages')}}" autocomplete="">
                @error('pages')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label>Edição</label>
                <input type="number" name="edition" class="form-control @error('edition') is-invalid @enderror" value="{{old('edition')}}" autocomplete="">
                @error('edition')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label>Data de Publicação</label>
                <input type="date"  name="publication_date" class="form-control @error('publication_date') is-invalid @enderror" value="{{old('publication_date')}}" placeholder="d/m/Y">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Cor</label>
                <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{old('color')}}" autocomplete="">
            </div>

            <div class="form-group col-md-3">
                <label>Capa</label>
                <input type="text" name="cape" class="form-control @error('cape') is-invalid @enderror" value="{{old('cape')}}" autocomplete="">
                @error('cape')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label>Editora</label>
                <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{old('company')}}" autocomplete="">
            </div>

            <div class="form-group col-md-3">
                <label>Autor</label>
                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{old('author')}}" autocomplete="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Sinopse</label>
                <textarea  id="example-textarea-input" name="synopsis" class="form-control" value="{{old('synopsis')}}" rows="6" placeholder="Sinopse..."></textarea>
            </div>

            <div class="form-group col-md-6">
                <label>Observações</label>
                <textarea id="example-textarea-input" name="observations" class="form-control @error('observations') is-invalid @enderror" value="{{old('observations')}}" rows="6" placeholder="Observações..."></textarea>
                @error('observations')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group float-right">
            <button type="submit" class="btn btn-info btn-lg btn-noborder">Concluir</button>
        </div>
    </form>
</div>
<script>$('input.date').flatpickr();</script>
@endsection