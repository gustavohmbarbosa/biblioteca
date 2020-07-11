<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
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
     * Display the specified reader.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $reader = auth('reader')->user();

        if ($reader->slug != $slug) {
            return $this->errorMessage("Não autorizado!", 401);
        }

        $reader->course;

        return response()->json(['data' => $reader]);
    }

    /**
     * Show all books already borrowed.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function showBooks($slug)
    {
        $reader = auth('reader')->user();

        if ($reader->slug != $slug) {
            return $this->errorMessage("Não autorizado!", 401);
        }

        $books = $reader->books;

        if (count($books) == 0) {
            return $this->errorMessage("Voce ainda não leu nenhum livro.");
        }

        return response()->json(['data' => $books], 200);
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

        $data['status'] = 'INATIVO';

        $reader = $this->reader->create($data);

        return $this->message("Perfil criado com sucesso!", 201);
    }

     /**
     * Update the specified reader in storage.
     *
     * @param  Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $reader = auth('reader')->user();

        if ($reader->slug != $slug) {
            return $this->errorMessage("Não autorizado!", 401);
        }

        $data = $this->validator($request, $reader->id);

        if(array_key_exists('password', $data)){
            $data['password'] = Hash::make($data['password']);
        }

        $reader->update($data);

        return $this->message("Perfil atualizado com sucesso!");
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
            'name'         => ['required', 'string', 'max:190'],
            'email'        => ['required', 'string', 'email', 'max:190', Rule::unique('readers')->ignore($id)],
            'password'     => [Rule::requiredIf(!$id), 'string', 'min:8', 'confirmed'],
            'phone'        => ['required', 'string'],
            'gender'       => ['required', Rule::in(['Masculino', 'Feminino'])],
            'grade'        => ['required', Rule::in(['1', '2', '3'])],
            'class'        => ['required', Rule::in(['A', 'B', 'C'])],
            'course_id'    => ['required', 'string', 'exists:courses,id'],
            'registration' => ['required', 'string'],
            'entry_year'   => ['required', 'size:4', 'date_format:Y'],
        ];

        $messages = [
            'required'       =>  'Este campo é obrigatório!',
            'date_format'    =>  'Essa não é uma data válida.',
            'size'           =>  'Campo deve ter exatamente :size números.',
            'min'            =>  'Campo deve ter no mínimo :min caracteres.',
            'max'            =>  'Campo deve ter no máximo :max caracteres.',
            'email'          =>  'Insira um endereço de e-mail válido!',
            'unique'         =>  'Este e-mail já esta em uso. Tente outro.',
            'confirmed'      =>  'As senhas não coincidem. Tente novamente.',
            'string'         =>  'Insira caracteres válidos!',
            'in'             =>  'Selecione um dos valores pré-informados.',
            'exists'         =>  'Esse curso não existe. Tente novamente.',
        ];

        return $data->validate($fields, $messages);
   }
}
