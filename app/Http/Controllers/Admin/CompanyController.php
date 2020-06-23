<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $company = $this->company->create($data);

        $return = ['data' => ['menssage' => 'Editora criada com sucesso!']];
        return response()->json($return, 201);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $company = $this->company->find($id);
        $company->update($data);

        $return = ['data' => ['menssage' => 'Editora #' . $id . ' atulizada com sucesso!']];
        return response()->json([$return], 200);
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
        $company->delete();

        $return = ['data' => ['menssage' => 'Editora #' . $id . ' excluída com sucesso!']];
        return response()->json([$return], 200);
    }
}
