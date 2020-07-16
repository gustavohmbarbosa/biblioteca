<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Messages;
use App\Book;

class BookController extends Controller
{
    use Messages;

    private $book;

    public function __construct(Book $book){
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
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
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $book = $this->book->where('slug', $slug)->first();

        if (is_null($book)) {
            return $this->errorMessage("Livro não encontrado.");
        }

        $book->company;
        $book->authors;

        return response()->json(['data' => $book]);
    }
}
