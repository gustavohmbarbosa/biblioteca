<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use App\Author;

class HomeController extends Controller
{
    private $book;

    public function __construct(Book $book){
        $this->book = $book;
    }

    /**
     * Display a most popular books and authors list and all categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->book->inRandomOrder()->take(20)->get();

        foreach ($books as $key => $book) {
            $books[$key]['company'] = $book->company;
            $books[$key]['authors'] = $book->authors;
        }

        $authors = Author::inRandomOrder()->take(8)->get();

        return response()->json(['data' => [
            'books' => $books, 
            'authors' => $authors,
        ]]);
    }
}
