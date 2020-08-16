<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\Messages;
use App\Author;
use App\Book;
use App\AuthorBook;

class AuthorBookController extends Controller
{
    use Messages;

    /**
	 * @var Loan
	 */
	private $authorBook;

	public function __construct(AuthorBook $authorBook)
	{
		$this->authorBook = $authorBook;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorBook = DB::table('author_book')
        ->join('books', 'books.id', '=', 'author_book.book_id')
        ->join('authors', 'authors.id', '=', 'author_book.author_id')
        ->select('author_book.*', 'books.title as book_title', 'books.subtitle as book_subtitle', 'authors.name as author_name')->get();

        return response()->json($authorBook);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        dd($data);
        $authorBook = $this->authorBook->create($data);
        return $this->message('Relação Autor-Livro criada com sucesso!', $authorBook->id, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authorBook = DB::table('author_book')
        ->join('books', 'books.id', '=', 'author_book.book_id')
        ->join('authors', 'authors.id', '=', 'author_book.author_id')
        ->where('author_book.id', '=', $id)
        ->select('author_book.*', 'books.title as book_title', 'books.subtitle as book_subtitle', 'authors.name as author_name')->get()->first();

        if (is_null($authorBook)) {
            return $this->errorMessage("Esta relação entre Autor e Livro não existe!");
        }

        return response()->json($authorBook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $authorBook = $this->authorBook->find($id);

        if (is_null($authorBook)) {
            return $this->errorMessage("Esta relação entre Autor e Livro não existe!");
        }

        $data = $this->validator($request);
        $authorBook->update($data);

        return $this->message("Relação Autor-Livro atualizada com sucesso!", $authorBook->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authorBook = $this->authorBook->find($id);

        if (is_null($authorBook)) {
            return $this->errorMessage("Esta relação entre Autor e Livro não existe!");
        }

        $authorBook->delete();

        return $this->message("Relação Autor-Livro deletada com sucesso", $authorBook->id);
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
            'author_id' =>  ['required', 'numeric', 'exists:authors,id'],
            'book_id'   =>  ['required', 'numeric', 'exists:books,id'],
        ];

        $messages = [
            'required'          =>  'Preencha esse campo.',
            'numeric'           =>  'Insira apenas números.',
            'author_id.exists'  =>  'Esse escritor não está cadastrado no sistema. Tente novamente.',
            'book_id.exists'    =>  'Esse livro não existe no acervo. Tente novamente.',
        ];

        return $data->validate($fields, $messages);
   }
}
