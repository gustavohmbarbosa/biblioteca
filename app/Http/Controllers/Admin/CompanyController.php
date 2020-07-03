<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\Messages;
use App\Company;

class CompanyController extends Controller
{
    use Messages;

    /**
	 * @var Company
	 */
	private $company;

	public function __construct(Company $company)
	{
		$this->company = $company;
    }

    /**
     * Display a list of companies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->company->paginate(10);

        return response()->json(['data' => $companies], 200);
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \Illuminate\Http\Requests\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        $company = $this->company->create($data);

        return $this->message("Editora criada com sucesso!", 201);
    }

    /**
     * Display the specified company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->company->find($id);

        if (is_null($company)) {
            return $this->errorMessage("Editora não encontrada.");
        }

        $books = DB::table('books')
        ->where('books.company_id', $id)
        ->select('books.title as book_title', 'books.id as book_id')
        ->get();

        $company['books'] = $books;

        return response()->json(['data' => $company], 200);
    }

    /**
     * Shows children of the given company.
     *
     * @param  int  $company
     * @return \Illuminate\Http\Response
     */
    public function showBooks($company)
    {
        $books = $this->company->find($company)->books;

        if (empty($books)) {
            return $this->errorMessage("Nenhum livro encontrada.");
        }

        return response()->json(['data' => $books], 200);
    }

    /**
     * Shows child of the given company.
     *
     * @param  int  $company
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    public function showBook($company, $book)
    {
        $book = $this->company->find($company)->books->find($book);

        if (is_null($book)) {
            return $this->errorMessage("Nenhum livro encontrado.");
        }

        return response()->json(['data' => $book], 200);
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \Illuminate\Http\Requests\CompanyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = $this->company->find($id);

        if (is_null($company)) {
            return $this->errorMessage("Editora não encontrada.");
        }

        $data = $this->validator($request);
        $company->update($data);

        return $this->message("Editora atualizada com sucesso!", 200);
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = $this->company->find($id);

        if (is_null($company)) {
            return $this->errorMessage("Editora não encontrada.");
        }

        $company->delete();

        return $this->message('Editora #' . $company->id . ' deletada com sucesso!');
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
            'name' => ['required', 'string', 'max:190'],
        ];

        $messages = [
            'required'  =>  'Este campo é obrigatório!',
            'string'    =>  'Insira caracteres válidos!',
            'max'       =>  'Campo deve ter no máximo :max caracteres.',
        ];

        return $data->validate($fields, $messages);
   }
}
