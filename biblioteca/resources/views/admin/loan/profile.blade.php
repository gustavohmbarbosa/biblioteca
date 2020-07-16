<h2>Dados do Empréstimo <span class="badge {{$loan->status == 'ATIVO' ?  'badge-success' : 'badge-danger'}}">{{$loan->status}}</span></h2>
<hr>
<p>Criação: {{$loan->created_at}}</p>
<p>Retorno previsto: {{$loan->estimated_date}}</p>
<p>Devolução do livro: {{$loan->return_date ? $loan->return_date : "O livro ainda não foi devolvido"}}</p>
<br>

<h2>Dados do Leitor</h2>
<hr>
<p>Nome: {{$loan->name}}</p>
<p>Série: {{$loan->year}}</p>
<p>Turma: {{$loan->class}}</p>
<p>Curso: {{$loan->course}}</p>
<br>

<h2>Dados do livro</h2>
<p>Título: {{$loan->title}}</p>
@if($loan->subtitle) <p>Sub Título: {{$loan->subtitle}}</p> @endif
