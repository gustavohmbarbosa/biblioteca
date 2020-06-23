<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //For queries
use App\Author;
use App\Book;
use App\AuthorBook;

class AuthorBookController extends Controller
{
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
        $data = $request->all();

        $this->authorBook->create($data);
        
        $return = ['data' => ['menssage' => 'Relação Autor-Livro criada com sucesso!']];
        return response()->json($return, 201);    
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

        return response()->json(['data' => $authorBook]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
        $data = $request->all();

        $authorBook = $this->authorBook->find($id);
        $authorBook->update($data);

        $return = ['data' => ['menssage' => 'Relacionamento Autor-Livro atualizado com sucesso!']];
        return response()->json($return, 201);    
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
        $authorBook->delete();

        $return = ['data' => ['menssage' => 'Relacionamento Autor-Livro #' . $authorBook->id . ' desfeito com sucesso!']];
        return response()->json($return, 201);   
    }
}
