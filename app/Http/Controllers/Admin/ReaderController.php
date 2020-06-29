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

        return $this->message("Reader created successfully!", "success", 201);
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
            return $this->message("Reader not found", "warning", 404, true);
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
            return $this->message("Books not found", "warning", 404, true);
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

        if (is_null($bokk)) {
            return $this->message("Reader not found", "warning", 404, true);
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
            return $this->message("Reader not found", "warning", 404, true);
        }

        $data = $request->validated();

        $reader->update($data);

        return $this->message("Reader updated successfully!", "success", 201);
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
            return $this->message("Reader not found", "warning", 404, true);
        }

        $reader->delete();

        return $this->message('Reader #' . $id . ' deleted successfully!', "success");
    }

    /**
     * Seach Reader
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
            return $this->message("Readers not found", "warning", 404, true);
        }

        return response()->json(['data' => $readers], 200);
    }
}
