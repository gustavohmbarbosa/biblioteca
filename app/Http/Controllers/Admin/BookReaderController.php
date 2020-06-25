<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //For queries
use App\BookReader;
use App\Reader;
use App\Book;

class BookReaderController extends Controller
{
    /**
	 * @var Loan
	 */
	private $loan;

	public function __construct(BookReader $loan)
	{
		$this->bookReader = $loan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = DB::table('book_reader')
        ->join('books', 'books.id', '=', 'book_reader.book_id')
        ->join('readers', 'readers.id', '=', 'book_reader.reader_id')
        ->join('courses', 'courses.id', '=', 'readers.course_id')
        ->select(
            'books.title', 
            'books.subtitle', 
            'readers.name AS name', 
            'readers.grade', 
            'readers.class',
            'readers.course_id', 
            'courses.name AS course_name', 
            'book_reader.*', 
        )->paginate(10);
        
        return response()->json(['data' => $loans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $readers = Reader::all(['id','name']);
        $books = Book::all(['id', 'title']);

        return response()->json(['data' => ['readers' => $readers, 'books' => $books]]);
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

        $data['estimated_date'] = date('Y-m-d', strtotime('+7 days'));

        $this->bookReader->create($data);
        
        $return = ['data' => ['menssage' => 'Empréstimo criado com sucesso!']];
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
        $loan = DB::table('book_reader')
        ->join('books', 'books.id', '=', 'book_reader.book_id')
        ->join('readers', 'readers.id', '=', 'book_reader.reader_id')
        ->where('book_reader.id', '=', $id)
        ->select('book_reader.*', 'books.title', 'books.subtitle', 'readers.name', 'readers.grade', 'readers.class', 'readers.course')->get()->first();

        return response()->json(['data' => $loan]);
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

        if ($data['status'] != 'ATIVO')
            $data['return_date'] = date('Y-m-d');

        $loan = $this->bookReader->find($id);
        $loan->update($data);

        $return = ['data' => ['menssage' => 'Empréstimo atualizado com sucesso!']];
        return response()->json($return, 201);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = $this->bookReader->find($id);
        $loan->delete();

        $return = ['data' => ['menssage' => 'Empréstimo #' . $loan->id . ' excluído com sucesso!']];
        return response()->json($return, 201);    
    }
}
