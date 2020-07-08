<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\Messages;
use App\Traits\Upload;
use App\Book;

class BookController extends Controller
{
    use Messages;
    use Upload;

    private $book;

    public function __construct(Book $book){
        $this->book = $book;
    }
    
    /**
     * Display a list of books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->book->paginate(10);

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
        $data['publication_date'] = date('Y-m-d');

        if($request->hasFile('cape')) {
            $data['cape'] = $this->imageUpload($request->file('cape'), 'books');
        }

        $this->book->create($data);

        return $this->message("Livro adicionado ao acervo com sucesso!", 201);
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

        return response()->json(['data' => $book]);
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
        $data['publication_date'] = date('Y-m-d');

        $book->update($data);

        return $this->message("Dados do livro atualizado com sucesso!");
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

        return $this->message('O livro ' . $book->title . ' foi removido do acervo!');
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

        if (empty($books)) {
            return $this->errorMessage("Nenhum livro foi encontrado.");
        }

        return response()->json(['data' => $books], 200);
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
            'title'             =>  ['required', 'string', 'max:190'],
            'subtitle'          =>  ['string', 'max:190'],
            'origin'            =>  ['required', Rule::in(['Doado', 'Comprado'])],
            'price'             =>  ['string'],
            'isbn'              =>  ['required', 'string', 'max:13'],
            'synopsis'          =>  ['string'],
            'pages'             =>  ['required', 'string', 'max:5'],
            'language'          =>  ['required', 'string', 'max:190'],
            'observations'      =>  ['string'],
            'edition'           =>  ['required', 'string', 'max:3'],
            'publication_date'  =>  ['required', 'date_format:d/m/Y'],
            'color'             =>  ['required', 'string'],
            'cdd'               =>  ['required', 'string'],
            'cape'              =>  ['string'],
            'company_id'        =>  ['required', 'string', 'exists:companies,id'],
        ];

        $messages = [
            'required'      =>  'Este campo é obrigatório!',
            'string'        =>  'Insira caracteres válidos!',
            'max'           =>  'Campo deve ter no máximo :max caracteres.',
            'in'            =>  'Selecione um dos valores pré-informados.',
            'exists'        =>  'Essa editora não existe. Tente novamente.',
            'date_format'   =>  'Essa não é uma data válida.',
        ];

        return $data->validate($fields, $messages);
   }
}
