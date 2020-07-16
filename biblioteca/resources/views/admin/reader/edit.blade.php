<form action="{{route('admin.reader.update', [$reader->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <input type="hidden" name="status" value="ATIVO">
    <div class="row">
        <div class="form-group col-md-6">
            <label>Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{$reader->name}}">
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{$reader->email}}">
            @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Senha</label>
            <input type="text" name="" class="form-control">
        </div>

        <div class="form-group col-md-3">
            <label>Confirmar Senha</label>
            <input type="text" name="" class="form-control">
        </div>

        <div class="form-group col-md-3">
            <label>Telefone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"  value="{{$reader->phone}}">
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group col-md-3">
            <label>Gênero</label>
            <select type="text" name="gender" class="form-control @error('gender') is-invalid @enderror">
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Série</label>
            <select type="text" name="year" class="form-control @error('year') is-invalid @enderror">
                <option value="1">1º ano</option>
                <option value="2">2º ano</option>
                <option value="3">3º ano</option>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label>Turma</label>
            <select type="text" name="class" class="form-control @error('class') is-invalid @enderror">
                <option value="A">A</option>
                <option value="B">B</option>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label>Curso</label>
            <select type="text" name="course" class="form-control @error('course') is-invalid @enderror">
                <option value="des">Desenvolvimento</option>
                <option value="log">Logística</option>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label>Matrícula</label>
            <input type="text" name="registration" class="form-control @error('registration') is-invalid @enderror"  value="{{$reader->registration}}">
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group float-right">
        <button id="button" type="submit" class="btn btn-info btn-lg btn-noborder" onclick="">Concluir</button>
    </div>
</form>
