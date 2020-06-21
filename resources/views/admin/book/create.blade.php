@extends('layouts.app')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

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
                <label for="author">Autor</label>
                <div class="input-group">
					<span class="input-group-btn input-group-prepend">
						<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalFormAuthor">
							+
						</button>
					</span>
					<select class="js-select2 form-control" name="author_id" id="author" tabindex="-1" aria-hidden="true" data-placeholder="Carregando..." data-select2-id="author">
						<option></option>
                        {{-- @if ($authors)
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        @else
                            <option>{{ __('Não há autores registrados') }}</option>
                        @endif --}}
					</select>
				</div>
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

{{-- Modal Form Author --}}

  <div class="modal fade" id="modalFormAuthor" tabindex="-1" role="dialog" aria-labelledby="modalFormAuthorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Adicionar Novo Author</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="formAuthor" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nome do Autor</label>
                                <input type="text" name="name" class="form-control" autocomplete="">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Voltar</button>
                            <button type="submit" class="btn btn-alt-success" id="btnSubmitFormAuthor">
                                <i class="fa fa-check"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>jQuery(function(){ Codebase.helpers(['select2', 'modal']); });</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script>

        {{-- Salvar o Autor --}}
        
        $(function(){
            $('form#formAuthor').submit(function(event){
                event.preventDefault()

                $.ajax({
                    url: "{{ route('admin.book.store.author') }}",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response){
                        console.log(response)
                    }
                })
            })
        })

        {{-- Recuperar os Autores --}}

        $("form#formAuthor").submit(function(){
            $(document).ready(function () {
                $.getJSON("{{ route('admin.book.return.authors') }}", function(datas){
                    let selectAuthor = $('select[name="author_id"]')
                    spanPlaceholder = $('span.select2-selection__placeholder')

                    selectAuthor.text("<option></option>") {{-- Resetando os valores --}}

                    $.each(datas, function(i, obj){
                        selectAuthor.append(`<option value='${obj.id}'>${obj.name}</option>`)
                    })

                    spanPlaceholder.text('Escolha o(s) autor(es)')
                })
            })  
        })

        $('#btnSubmitFormAuthor').click(function(){
            $("#modalFormAuthor").modal('hide')
        })

        $(function(){
            $(document).ready(function () {
                $.getJSON("{{ route('admin.book.return.authors') }}", function(datas){
                    let selectAuthor = $('select[name="author_id"]')
                    spanPlaceholder = $('span.select2-selection__placeholder')

                    $.each(datas, function(i, obj){
                        selectAuthor.append(`<option value='${obj.id}'>${obj.name}</option>`)
                    })

                    spanPlaceholder.text('Escolha o(s) autor(es)')
                })
            })
        })
    </script>
@endsection