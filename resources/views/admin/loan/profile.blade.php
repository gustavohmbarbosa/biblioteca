<h2>Previsão de Devolução: {{$loan->estimated_date}}</h2>
<span class="badge {{$loan->status == 'ATIVO' ?  'badge-success' : 'badge-danger'}}">{{$loan->status}}</span>