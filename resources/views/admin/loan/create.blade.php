@extends('layouts.app')

@section('content')
<div class="content">
    <h2>Novo Emprestimo</h2>
    <hr>
    <form action="{{route('admin.loan.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="form-group col-md-6">
                <label>Leitor</label>
                <input type="text" name="" class="form-control" autocomplete="">
            </div>
            <div class="form-group col-md-6">
                <label>Livro</label>
                <input type="text" name="" class="form-control" autocomplete="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label>Previsão de Devolução</label>
                <input type="date" name="estimated_date" class="form-control" autocomplete="">
            </div>
        </div>
        <div class="form-group float-right">
            <button type="submit" class="btn btn-info btn-lg btn-noborder">Concluir</button>
        </div>
    </form>
</div>
@endsection