@extends('layouts.app')

@section('content')
    <div class="content">
        <table class="table table-bordered table-hover table-striped">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $book->id }}</td>
                </tr>

                <tr>
                    <th>Título</th>
                    <td>{{ $book->title }}</td>
                </tr>

                <tr>
                    <th>Subtítulo</th>
                    <td>{{ $book->subtitle }}</td>
                </tr>

                <tr>
                    <th>Origem</th>
                    <td>{{ $book->origin }}</td>
                </tr>

                <tr>
                    <th>Preço</th>
                    <td>R$ {{ number_format($book->price, 2, '.', ',') }}</td>
                </tr>

                <tr>
                    <th>ISBN</th>
                    <td>{{ $book->isbn }}</td>
                </tr>

                <tr>
                   <th>CDD</th>
                    <td>{{ $book->cdd }}</td> 
                </tr>
                
                <tr>
                    <th>Páginas</th>
                    <td>{{ $book->pages }}</td>
                </tr>

                <tr>
                    <th>Língua</th>
                    <td>{{ $book->language }}</td>
                </tr>
                
                <tr>
                   <th>Edição</th>
                    <td>{{ $book->edition }}</td> 
                </tr>
                
                <tr>
                    <th>Publicação</th>
                    <td>{{ $book->publication_date }}</td>
                </tr>
                
                <tr>
                    <th>Cor</th>
                    <td>{{ $book->color }}</td>
                </tr>
                
                <tr>
                    <th>Capa</th>
                    <td>{{ $book->cape }}</td>
                </tr>
                
                <tr>
                    <th>Editora</th>
                    <td>{{ $book->company }}</td>
                </tr>
                
                <tr>
                    <th>Autor</th>
                    <td>{{ $book->author }}</td>
                </tr>
                
                <tr>
                   <th>Sinopse</th>
                    <td>{{ $book->synopsis }}</td> 
                </tr>
                
                <tr>
                    <th>Observações</th>
                    <td>{{ $book->observations }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection