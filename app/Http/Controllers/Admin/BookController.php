<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
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
        
        // Retornando os Autores de Todos os Livros...
        foreach ($books as $key => $book) {
            $books[$key]['company'] = $book->company;
            $books[$key]['authors'] = $book->authors;
        }

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->validated();

        $this->book->create($data);

        return $this->message("Book created successfully!", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->book->find($id);

        if (is_null($book)) {
            return $this->message("Book not found.", 404, true);
        }

        $book->company;
        $book->authors;

        return response()->json(['data' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $book = $this->book->find($id);

        if (is_null($book)) {
            return $this->message("Book not found", 404, true);
        }

        $data = $request->validated();
        $book->update($data);

        return $this->message("Book updated successfully!", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = $this->book->find($id);

        if (is_null($book)) {
            return $this->message("Book not found", 404, true);
        }

        $book->delete();

        return $this->message('Book ' . $book->title . ' deleted successfully!');
    }
}
