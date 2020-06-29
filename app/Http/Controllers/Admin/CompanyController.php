<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Traits\Messages;
use Illuminate\Support\Facades\DB; //For queries
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->company->paginate(10);

        return response()->json(['data' => $companies], 200);
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
     * @param  \Illuminate\Http\Requests\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
        $company = $this->company->create($data);

        return $this->message("Company created successfully", "success", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->company->find($id);

        if (is_null($company)) {
            return $this->message("Company not found", "warning", 404, true);
        }

        $books = DB::table('books')
        ->where('books.company_id', $id)
        ->select('books.title as book_title', 'books.id as book_id')
        ->get();

        $company['books'] = $books;

        return response()->json(['data' => $company], 200);
    }

    /**
     * Shows children of the given resource.
     *
     * @param  int  $company
     * @return \Illuminate\Http\Response
     */
    public function showBooks($company)
    {
        $books = $this->company->find($company)->books;

        if (empty($books)) {
            return $this->message("Books not found", "warning", 404, true);
        }

        return response()->json(['data' => $books], 200);
    }

    /**
     * Shows child of the given resource.
     *
     * @param  int  $company
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    public function showBook($company, $book)
    {
        $book = $this->company->find($company)->books->find($book);

        if (is_null($books)) {
            return $this->message("Book not found", "warning", 404, true);
        }

        return response()->json(['data' => $book], 200);
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
     * @param  \Illuminate\Http\Requests\CompanyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = $this->company->find($id);

        if (is_null($company)) {
            return $this->message("Company not found", "warning", 404);
        }

        $data = $request->validated();
        $company->update($data);

        return $this->message("Company updated successfully!", "success", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = $this->company->find($id);

        if (is_null($company)) {
            return $this->message("Company not found", "warning", 404, true);
        }

        $company->delete();

        return $this->message('Company #' . $id . ' deleted successfully!', 'success', 201);
    }
}
