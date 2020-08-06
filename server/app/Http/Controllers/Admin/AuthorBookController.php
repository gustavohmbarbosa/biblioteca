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

        return response()->json(['data' => $authorBook]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all(['id','name']);
        $books = Book::all(['id', 'title']);

        return response()->json(['data' => ['authors' => $authors, 'books' => $books]]);
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

        $this->authorBook->create($data);
        return $this->message('Relation Author-Book created successfully', 201);
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
            return $this->errorMessage("Relation Author-Book not found");
        }

        return response()->json(['data' => $authorBook]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @var string $authors
     * @var string $books
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::all(['id','name']);
        $books = Book::all(['id', 'title']);

        return response()->json(['data' => ['authors' => $authors, 'books' => $books]]);
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
            return $this->errorMessage("Relation Author-Book not found");
        }

        $data = $this->validator($request);
        $authorBook->update($data);

        return $this->message("Relation Author-Book updated successfully");
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
            return $this->errorMessage("Relation Author-Book not found");
        }

        $authorBook->delete();

        return $this->message("Relation Author-Book deleted successfully");
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
            'author_id' =>  ['required', 'string', 'exists:authors,id'],
            'book_id'   =>  ['required', 'string', 'exists:books,id'],
        ];

        $messages = [
            'required'          =>  'Este campo é obrigatório!',
            'string'            =>  'Insira caracteres válidos!',
            'author_id.exists'  =>  'Esse escritor não está cadastrado no sistema. Tente novamente.',
            'book_id.exists'    =>  'Esse livro não existe no arcevo. Tente novamente.',
            'in'                =>  'Selecione um dos valores pré-informados.',
        ];

        return $data->validate($fields, $messages);
   }
}
