<form action="{{route('admin.loan.update', [$loan->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <input type="hidden" name="status" value="ATIVO">
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