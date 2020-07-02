<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReaderRequest;
use App\Traits\Messages;
use App\Reader;

class ReaderController extends Controller
{
    use Messages;

    /**
	 * @var Reader
	 */
	private $reader;

	public function __construct(Reader $reader)
	{
		$this->reader = $reader;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = $this->reader->paginate(10);

        return response()->json($readers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReaderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReaderRequest $request)
    {
        $data = $request->validated();

        $reader = $this->reader->create($data);

        return $this->message("Leitor criado com sucesso!", 201);
    }

    /**
     * Display the specified resource.
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

        return response()->json(['data' => $reader]);
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

        if (empty($books)) {
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

        return response()->json(['data' => $book], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReaderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReaderRequest $request, $id)
    {
        $reader = $this->reader->find($id);

        if (is_null($reader)) {
            return $this->errorMessage("Leitor não encontrado.");
        }

        $data = $request->validated();

        $reader->update($data);

        return $this->message("Leitor atualizado com sucesso!");
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
            return $this->errorMessage("Leitor não encontrado.");
        }

        $reader->delete();

        return $this->message('Leitor #' . $id . ' deletado com sucesso!');
    }

    /**
     * Search Reader
     * @var array $request
     */
    public function search(Request $request)
    {
        $filter = $request->filter;
        $column = $request->column;

        if (is_null($column)){
            $column = 'name';
        }

        $readers = $this->reader->search($filter, $column);

        if (empty($readers)) {
            return $this->errorMessage("Nenhum leitor foi encontrado.");
        }

        return response()->json(['data' => $readers], 200);
    }
}
