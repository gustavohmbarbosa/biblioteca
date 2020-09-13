<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\Messages;
use App\Traits\Upload;
use App\Book;
use App\AuthorBook;

class BookController extends Controller
{
    use Messages;
    use Upload;

    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Display a list of books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $books = $this->book->all();

      foreach ($books as $key => $book) {
          $books[$key]['company'] = $book->company;
          $books[$key]['authors'] = $book->authors;
      }

      return response()->json($books);
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $this->validator($request);

      if($request->hasFile('cape')) {
        $data['cape'] = $this->imageUpload($request->file('cape'), 'books');
      }

      $book = $this->book->create($data);

      foreach ($data['author_id'] as $author) {
        $book->authors()->attach($author);
      }

      return $this->message("Livro adicionado ao acervo com sucesso!", $book->id, 201);
    }

    /**
     * Display the specified book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->book->find($id);

        if (is_null($book)) {
            return $this->errorMessage("Livro não encontrado.");
        }

        $book->company;
        $book->authors;

        if (!is_null($book->image))
            $book->cape = asset('storage/' . $book->cape);

        return response()->json($book);
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = $this->book->find($id);

        if (is_null($book)) {
            return $this->errorMessage("Livro não encontrado.");
        }

        $data = $this->validator($request);

        if($request->hasFile('cape')) {
            if(Storage::disk('public')->exists($book->cape)) {
                Storage::disk('public')->delete($book->cape);
            }
            $data['cape'] = $this->imageUpload($request->file('cape'), 'books');
        }

        $data['publication_year'] = date('Y-m-d', strtotime($data['publication_year']));

        $book->update($data);

        return $this->message("Dados do livro atualizado com sucesso!", $book->id);
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = $this->book->find($id);

        if (is_null($book)) {
            return $this->errorMessage("Livro não encontrado.");
        }

        $book->delete();

        return $this->message('O livro ' . $book->title . ' foi removido do acervo!', $book->id);
    }

    /**
     * Search Books
     * @var array $request
     *
     */
    public function search(Request $request)
    {
        $filter = $request->filter;
        $column = $request->column;

        if (is_null($column)){
            $column = 'title';
        }

        $books = $this->book->search($filter, $column);

        if (count($books) == 0) {
            return $this->errorMessage("Nenhum livro foi encontrado.");
        }

        return response()->json($books, 200);
    }

    /**
    * Get a validator.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator($data)
   {
        $fields = [
            'title'            => ['required', 'string', 'max:190'],
            'subtitle'         => ['nullable', 'string', 'max:190'],
            'origin'           => ['required', Rule::in(['Doado', 'Comprado'])],
            'price'            => ['nullable', 'max:7'],
            'isbn'             => ['required', 'string', 'max:13'],
            'synopsis'         => ['nullable', 'string', 'max:1000'],
            'pages'            => ['required', 'string', 'max:5'],
            'language'         => ['required', 'string', 'max:190'],
            'observations'     => ['nullable', 'string', 'max:190'],
            'edition'          => ['required', 'string', 'max:3'],
            'publication_year' => ['required', 'size:4', 'date_format:Y'],
            'color'            => ['required', 'string'],
            'cdd'              => ['required'],
            'cape'             => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
            'company_id'       => ['required', 'exists:companies,id'],
            'author_id'        => ['nullable', 'array'],
        ];

        foreach($data['author_id'] as $key => $val)
        {
          $fields['author_id.' . $key] =  ['required', 'exists:authors,id'];
        }

        $messages = [
            'required'          => 'Preencha esse campo.',
            'string'            => 'Insira caracteres válidos.',
            'max'               => 'Campo deve ter no máximo :max caracteres.',
            'in'                => 'Selecione um dos valores pré-informados.',
            'company_id.exists' => 'Essa editora ainda não foi cadastrada.',
            'date_format'       => 'Essa não é uma data válida.',
            'size'              => 'Campo deve ter exatamente :size números.',
            'image'             => 'A capa deve ser uma imagem.',
            'mimes'             => 'A imagem deve se do tipo: jpeg, jpg ou png.',
            'array'             => 'Preencha novamente.'
        ];

        foreach($data['author_id'] as $key => $val)
        {
          $messages['author_id.' . $key . '.exists'] =  'O autor selecionado ainda não foi cadastrado.';
        }

        return $data->validate($fields, $messages);
   }
}
