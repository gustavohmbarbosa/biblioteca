<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Messages;
use App\Traits\Upload;
use App\Author;

class AuthorController extends Controller
{
    use Messages;
    use Upload;

    private $author;

    public function __construct(Author $author){

        $this->author = $author;

    }

    /**
     * Display a listing of authors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = $this->author->all(['id', 'name']);

        return response()->json(['data' => $authors]);
    }

    /**
     * Store a newly created author in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);

        if($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request->file('image'), 'authors');
        }

        $this->author->create($data);

        return $this->message("Autor adicionado com sucesso!", 201);
    }

    /**
     * Display the specified author.
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
     * Update the specified author in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $author = $this->author->find($id);

        if(is_null($author)){
            return $this->errorMessage("Autor não encontrado.");
        }

        $data = $this->validator($request);
        $author->update($data);

        return $this->message('Dados do autor atualizados com sucesso!');
    }

    /**
     * Remove the specified author from storage.
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

    /**
    * Get a validator.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator($data)
   {
        $fields = [
            'name'      => ['required', 'string', 'max:190'],
            'biography' => ['string'],
        ];

        $messages = [
            'required'  =>  'Este campo é obrigatório!',
            'string'    =>  'Insira caracteres válidos!',
            'max'       =>  'Campo deve ter no máximo :max caracteres.',
        ];

        return $data->validate($fields, $messages);
   }
}
