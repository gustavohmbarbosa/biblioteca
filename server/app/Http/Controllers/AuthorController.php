<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Messages;
use App\Author;

class AuthorController extends Controller
{
    use Messages;

    private $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = $this->author->orderBy('name')->get();

        return response()->json(['data' => $authors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $author = $this->author->where('id', $slug)->first();

        if(is_null($author)){
            return $this->errorMessage("Autor não encontrado.");
        }
        
        $author->books;

        return response()->json(['data' => $author]);
    }
}
