<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Book;

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
        $books = $this->book->paginate(10);
        
        foreach ($books as $key => $book) {
            $books[$key]['company'] = $book->company;
            $books[$key]['authors'] = $book->authors;
        }

        return response()->json($books);
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
    public function store(BookRequest $request)
    {
        try {

            $data = $request->all();
            $this->book->create($data);

            return response()->json(['message' => 'Livro criado com sucesso!'], 201);

        } catch (\Exception $e) {
           
            return response()->json(['message' => 'Falha ao criar livro!'], 1010);

        }
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
        $book->company;
        $book->authors;

        return response()->json(['data' => $book]);
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
        try {

            $data = $request->all();
            $book = $this->book->find($id);
            $book->update($data);

            return response()->json(['message' => 'Livro atualizado com sucesso!'], 201);

        } catch (\Exception $e) {
           
            return response()->json(['message' => 'Falha ao atualizar livro!'], 1011);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $book = $this->book->find($id);
            $book->delete();

            return response()->json(['message' => 'Livro ' . $book->title . ' deletado com sucesso!']);

        } catch (\Exception $e) {
            
            return response()->json(['message' => 'Falha ao deletar livro!'], 1012);

        }
    }
}
