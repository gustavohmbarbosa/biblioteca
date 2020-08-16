<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Traits\Messages;
use App\Traits\Upload;
use App\Reader;

class ReaderController extends Controller
{
    use Messages;
    use Upload;

    /**
	 * @var Reader
	 */
	private $reader;

	public function __construct(Reader $reader)
	{
		$this->reader = $reader;
    }

    /**
     * Display a list of readers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = $this->reader->all();

        return response()->json($readers);
    }

    /**
     * Store a newly created reader in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        $data['password'] = Hash::make($data['password']);

        if($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request->file('image'), 'readers');
        }

        $reader = $this->reader->create($data);

        return $this->message("Leitor criado com sucesso!", $reader->id, 201);
    }

     /**
     * Update the specified reader in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reader = $this->reader->find($id);

        if (is_null($reader)) {
            return $this->errorMessage("Leitor não encontrado.");
        }

        $data = $this->validator($request, $reader->id);

        if(array_key_exists('password', $data)){
            $data['password'] = Hash::make($data['password']);
        }

        if($request->hasFile('image')) {
            if(Storage::disk('public')->exists($reader->image)) {
                Storage::disk('public')->delete($reader->image);
            }
            $data['image'] = $this->imageUpload($request->file('image'), 'readers');
        }

        $reader->update($data);

        return $this->message("Leitor atualizado com sucesso!", $reader->id);
    }

    /**
     * Display the specified reader.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reader = $this->reader->find($id);

        if (is_null($reader)) {
            return $this->errorMessage("Leitor não encontrado.");
        }

        $reader->course;
        $reader['course_id'] = $reader->course->id;

        return response()->json($reader);
    }

    /**
     * Show all books already borrowed.
     *
     * @param  int  $reader
     * @return \Illuminate\Http\Response
     */
    public function showBooks($reader)
    {
        $books = $this->reader->find($reader)->books;

        if (count($books) == 0) {
            return $this->errorMessage("Nenhum livro foi encontrado.");
        }

        return response()->json(['data' => $books], 200);
    }

    /**
     * Show book already borrowed.
     *
     * @param  int  $reader
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    public function showBook($reader, $book)
    {
        $book = $this->reader->find($reader)->books->find($book);

        if (is_null($book)) {
            return $this->errorMessage("Nenhum livro foi encontrado.");
        }

        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reader = $this->reader->find($id);

        if (is_null($reader)) {
            return $this->errorMessage("Este leitor não existe.");
        }

        $reader->delete();

        return $this->message('Leitor #' . $id . ' deletado com sucesso!', $reader->id);
    }

    /**
     * Search Reader
     *
     * @param  array  $request
     */
    public function search(Request $request)
    {
        $filter = $request->filter;
        $column = $request->column;

        if (is_null($column)){
            $column = 'name';
        }

        $readers = $this->reader->search($filter, $column);

        if (count($readers) == 0) {
            return $this->errorMessage("Nenhum leitor foi encontrado.");
        }

        return response()->json(['data' => $readers], 200);
    }

    /**
    * Get a validator.
    *
    * @param  array  $data
    * @param  int    $id
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator($data, $id = null)
   {
        $fields = [
            'name'            => ['required', 'string', 'max:190'],
            'email'           => ['required', 'string', 'email', 'max:190', Rule::unique('readers')->ignore($id)],
            'password'        => [Rule::requiredIf(!$id), 'string', 'min:8', 'confirmed'],
            'password_confirmation'=> ['required_with:password', 'same:password'],
            'phone'           => ['required', 'string'],
            'gender'          => ['required', Rule::in(['Masculino', 'Feminino', 'Não-Binário','Desejo não informar'])],
            'grade'           => ['required', Rule::in(['1', '2', '3'])],
            'class'           => ['required', Rule::in(['A', 'B', 'C'])],
            'course_id'       => ['required', 'exists:courses,id'],
            'registration'    => ['required', 'string'],
            'entry_year'      => ['required', 'size:4', 'date_format:Y'],
            // 'image'           => ['image', 'mimes:jpeg,jpg,png'],
            // 'status'          => [Rule::in(['Ativo', 'Inativo', 'Bloqueado'])],
        ];

        $messages = [
            'required'      => 'Preencha esse campo.',
            'required_with' => 'Este campo é obrigatório quando a senha é informada.',
            'confirmed'     => 'As senhas não coincidem.',
            'same'          => 'As senhas não coincidem.',
            'date_format'   => 'Essa não é uma data válida.',
            'size'          => 'Campo deve ter exatamente :size números.',
            'min'           => 'Campo deve ter no mínimo :min caracteres.',
            'max'           => 'Campo deve ter no máximo :max caracteres.',
            'email'         => 'Insira um endereço de e-mail válido!',
            'unique'        => 'Este e-mail já esta em uso. Tente outro.',
            'string'        => 'Insira caracteres válidos.',
            'in'            => 'Selecione um dos valores pré-informados.',
            'exists'        => 'Esse curso não existe. Tente novamente.',
            // 'image'         => 'Você deve inserir uma imagem.',
            // 'mimes'         => 'A imagem deve se do tipo: jpeg, jpg ou png.'
        ];

        return $data->validate($fields, $messages);
   }
}
