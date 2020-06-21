<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
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
        $books = $this->book->all();

        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('admin.book.create');
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

        $book = $this->book->create($data);

        return redirect()->route('admin.book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->book->findOrFail($id);

        return view('admin.book.main', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

        $book = $this->book->findOrFail($id);
        $book = $book->update($data);

        return redirect()->route('admin.book.show', compact('book'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = $this->book->findOrFail($id);
        $book->delete();

        return redirect()->route('admin.book.index');
    }

    public function storeAuthor(Request $request) {
        $data = $request->all();

        if (\App\Author::create($data)) {
            $message['content'] = "Autor criado com sucesso!";
            $message['type'] = "success";
        } else {
            $message['content'] = "Erro ao criar o autor!";
            $message['type'] = "danger";
        }

        echo json_encode($message);

        return;

        // return redirect()->route('admin.book.create');
    }

    public function returnAuthors() {
        $authors = \App\Author::all(['id', 'name']);

        echo json_encode($authors);
    }
}
