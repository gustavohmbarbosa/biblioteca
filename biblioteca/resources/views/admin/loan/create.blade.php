@extends('layouts.app')

@section('content')
<div class="content">
    <h2>Novo Empréstimo</h2>
    <hr>
    <form action="{{route('admin.loan.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            @if ($readers)
                <div class="form-group col-md-6">
                    <label>Leitor</label>
                    <select name="reader_id" class="form-control" autocomplete="">
                        @foreach ($readers as $reader)
                            <option value="{{$reader->id}}">{{$reader->name}}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <a href="{{route('admin.reader.create')}}" type="button" class="btn btn-success mr-5 mb-5 btn-noborder">
                    <i class="fa fa-plus mr-5"></i>Adicionar Leitores
                </a>
            @endif

            @if ($books)
                <div class="form-group col-md-6">
                    <label>Livro</label>
                    <select name="book_id" class="form-control" autocomplete="">
                        @foreach ($books as $book)
                            <option value="{{$book->id}}">{{$book->title}}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <a href="{{route('admin.book.create')}}" type="button" class="btn btn-success mr-5 mb-5 btn-noborder">
                    <i class="fa fa-plus mr-5"></i>Adicionar Livros
                </a>
            @endif
        </div>

        @if ($readers && $books)
            <div class="form-group float-right">
                <button type="submit" class="btn btn-info btn-lg btn-noborder">Concluir</button>
            </div>
        @endif
    </form>
</div>
@endsection