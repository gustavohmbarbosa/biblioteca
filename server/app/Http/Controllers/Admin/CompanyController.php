<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $companies = $this->company->all();

        return response()->json($companies);
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

        return response()->json([
            "message" => "Editora criada com sucesso!",
            "data" => $company,
        ], 201);
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

        return response()->json($company, 200);
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

        return response()->json($books, 200);
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

        return response()->json($book, 200);
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

        return response()->json([
            "message" => "Editora atualizada com sucesso!",
            "data" => $company,
        ]);
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

        return $this->message('Editora #' . $company->id . ' deletada com sucesso!', $company->id);
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
            'about' => ['nullable', 'string', 'max:5000'],
        ];

        $messages = [
            'required' => 'Preencha esse campo.',
            'string' => 'Insira caracteres válidos.',
            'max' => 'Campo deve ter no máximo :max caracteres.',
        ];

        return $data->validate($fields, $messages);
    }
}