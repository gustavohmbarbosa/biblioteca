<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Traits\Messages;
use App\Author;

class AuthorController extends Controller
{
    use Messages;

    private $author;

    public function __construct(Author $author){

        $this->author = $author;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = $this->author->all(['id', 'name']);

        return response()->json(['data' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
    {
        $data = $request->validated();
        $this->author->create($data);

        return $this->message("Autor adicionado com sucesso!", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = $this->author->find($id);

        if(is_null($author)){
            return $this->errorMessage("Autor não encontrado.");
        }

        return response()->json(['data' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, $id)
    {
        $author = $this->author->find($id);

        if(is_null($author)){
            return $this->errorMessage("Autor não encontrado.");
        }

        $data = $request->validated();
        $author->update($data);

        return $this->message('Dados do autor atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = $this->author->find($id);

        if(is_null($author)){
            return $this->errorMessage("Autor não encontrado.");
        }

        $author->delete();

        return $this->message('Autor #' . $author->id . ' removido com sucesso!');
    }
}
