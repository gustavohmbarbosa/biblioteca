@extends('layouts.app')

 <!--JS TABLE-->
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
<div class="content">
    <h2>Livros
        <a href="{{route('admin.book.create')}}" type="button" class="btn btn-primary mr-5 mb-5 float-right btn-noborder">
            <i class="fa fa-plus mr-5"></i>Novo Livro
        </a>
    </h2>
    <hr>
    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="table">
                <thead>
                    <tr>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Título</th>
                            <th>Editora</th>
                            <th>Autor</th>
                            <th>Ações</th>
                        </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->company}}</td>
                            <td>{{$book->author}}</td>
                            <td>
                                <div class="form-group text-center">
                                    <a href="{{route('admin.book.show', ['book' => $book->id])}}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{route('admin.book.edit', ['book' => $book->id])}}" class="btn btn-sm btn-info">Editar</a>
                                    
                                    <form action="{{route('admin.book.destroy', ['book' => $book->id])}}" method="post" class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

@endsection