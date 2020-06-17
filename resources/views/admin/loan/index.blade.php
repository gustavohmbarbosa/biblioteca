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
    <h2>Empréstimos
        <a href="{{route('admin.loan.create')}}" type="button" class="btn btn-info mr-5 mb-5 float-right btn-noborder">
            <i class="fa fa-plus mr-5"></i>Novo Emprétimo
        </a>
    </h2>
    <hr>
    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Leitor</th>
                            <th>Livro</th>
                            <th>Devolução Prevista</th>
                            <th>Ações</th>
                        </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{$loan['id']}}</td>
                            <td>{{$loan['reader_name']}}</td>
                            <td>{{$loan['book_title']}}</td>
                            <td class="text-center"><Span class="badge {{$loan['status'] == 'ATIVO' ?  'badge-success' : 'badge-danger'}}">{{$loan['status']}}</Span></td>
                            <td>
                                <div class="form-group text-center">
                                    <a href="{{route('admin.loan.show', ['loan' => $loan['id']])}}" class="btn btn-sm btn-primary btn-noborder">Visualizar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

@endsection