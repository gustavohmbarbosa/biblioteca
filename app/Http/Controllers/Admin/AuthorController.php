<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        try {

            $this->author->create($data);

            $message = [
                'content' => "Autor criado com sucesso!",
                'type'    => "success"
            ];

        } catch (\Exception $e) {

            $message = [
                'content' => "Falha ao criar autor!",
                'type'    => "danger"
            ];

        }

        // echo json_encode($message);

        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = ['data' => $this->author->findOrFail($id)];

        return response()->json($author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $author = $this->author->findOrFail($id);

        try {

            $author->update($data);

            $message = [
                'content' => "Autor atualizado com sucesso!",
                'type'    => "success"
            ];

        } catch (\Exception $e) {

            $message = [
                'content' => "Falha ao atualizar autor!",
                'type'    => "danger"
            ];

        }

        // echo json_encode($message);

        return response()->json($message);
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

            $author = $this->author->findOrFail($id);
            $author->delete();

            return response()->json(['message' => 'Autor ' . $author->name . ' deletado com sucesso!']);

        } catch (\Exception $e) {
            
            return response()->json(['message' => 'Falha ao deletar autor!'], 1012);

        }
    }
}
