<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\Traits\Messages;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        // $data = $this->validator($request);
        dd($request->all());
        if ($request->hasFile('cape')) {
            $data['cape'] = $this->imageUpload($request->file('cape'), 'books');
        }

        $book = $this->book->create($data);

        foreach ($data['authors_id'] as $authorId) {
            $book->authors()->attach($authorId);
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
        $book = $this->book->with(['company:id,name', 'authors:id,name'])->find($id);

        if (is_null($book)) {
            return response()->json(["message" => "Livro não encontrado."], 404);
        }

        if (!is_null($book->image)) {
            $book->cape = asset('storage/' . $book->cape);
        }

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

        if ($request->hasFile('cape')) {
            if (Storage::disk('public')->exists($book->cape)) {
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

        if (is_null($column)) {
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
            'title' => ['required', 'string', 'max:190'],
            'subtitle' => ['nullable', 'string', 'max:190'],
            'origin' => ['required', Rule::in(['Doado', 'Comprado'])],
            'price' => ['nullable', 'max:7'],
            'isbn' => ['required', 'string', 'max:13'],
            'synopsis' => ['nullable', 'string', 'max:5000'],
            'pages' => ['required', 'string', 'max:5'],
            'language' => ['required', 'string', 'max:190'],
            'observations' => ['nullable', 'string', 'max:190'],
            'edition' => ['nullable', 'string', 'max:3'],
            'publication_year' => ['required', 'size:4', 'date_format:Y'],
            'color' => ['nullable', 'string'],
            'cdd' => ['nullable'],
            'cape' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
            'company_id' => ['required', 'exists:companies,id'],
            'authors_id' => ['nullable', 'array'],
        ];

        $messages = [
            'required' => 'Preencha esse campo.',
            'string' => 'Insira caracteres válidos.',
            'max' => 'Campo deve ter no máximo :max caracteres.',
            'in' => 'Selecione um dos valores pré-informados.',
            'company_id.exists' => 'Essa editora ainda não foi cadastrada.',
            'date_format' => 'Essa não é uma data válida.',
            'size' => 'Campo deve ter exatamente :size números.',
            'image' => 'A capa deve ser uma imagem.',
            'mimes' => 'A imagem deve se do tipo: jpeg, jpg ou png.',
            'array' => 'Preencha novamente.',
        ];

        if ($data['authors_id']) {
            foreach ($data['authors_id'] as $key => $val) {
                $fields['authors_id.' . $key] = ['required', 'exists:authors,id'];
            }

            foreach ($data['authors_id'] as $key => $val) {
                $messages['authors_id.' . $key . '.exists'] = 'O autor selecionado ainda não foi cadastrado.';
            }
        }

        return $data->validate($fields, $messages);
    }
}