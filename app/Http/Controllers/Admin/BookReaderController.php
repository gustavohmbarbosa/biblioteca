<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Traits\Messages;
use App\BookReader;
use App\Reader;
use App\Book;

class BookReaderController extends Controller
{
    use Messages;

    /**
	 * @var Loan
	 */
	private $loan;

	public function __construct(BookReader $loan)
	{
		$this->bookReader = $loan;
    }

    /**
     * Display a listing of the loans.
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
     * Show the form for creating a new loan.
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
     * Store a newly created loan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        $data['estimated_date'] = date('Y-m-d', strtotime('+7 days'));

        $loan = $this->bookReader->create($data);

        return $this->message("Empréstimo criado com sucesso!", 201);
    }

    /**
     * Display the specified loan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan = DB::table('book_reader')
        ->join('books', 'books.id', '=', 'book_reader.book_id')
        ->join('readers', 'readers.id', '=', 'book_reader.reader_id')
        ->join('courses', 'courses.id', '=', 'readers.course_id')
        ->where('book_reader.id', '=', $id)
        ->select(
        'book_reader.*',
        'books.title',
        'books.subtitle',
        'readers.name',
        'readers.grade',
        'readers.class',
        'courses.name as course_name'
        )->get()->first();

        if (is_null($loan)) {
            return $this->errorMessage("Nenhum dado foi encontrado.");
        }

        return response()->json(['data' => $loan]);
    }

    /**
     * Show the form for editing the specified loan.
     *
     * @param  int  $id
     * @var string $readers
     * @var string $books
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $readers = Reader::all(['id','name']);
        $books = Book::all(['id', 'title']);

        return response()->json(['data' => ['readers' => $readers, 'books' => $books]]);
    }

    /**
     * Update the specified loan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loan = $this->bookReader->find($id);

        if (is_null($loan)) {
            return $this->errorMessage("Nenhum dado foi encontrado.");
        }

        $data = $this->updateValidator($request);

        if ($data['status'] != 'ATIVO') {
            $data['return_date'] = date('Y-m-d');
        }
 
        $loan->update($data);

        return $this->message("Os dados atualizados com sucesso!");
    }

    /**
     * Remove the specified loan from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = $this->bookReader->find($id);

        if (is_null($loan)) {
            return $this->errorMessage("Nenhum dado foi encontrado.");
        }

        $loan->delete();

        return $this->message('Empréstimo #' . $loan->id . ' deletado com sucesso!');
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
            'reader_id' =>  ['required', 'string', 'exists:readers,id'],
            'book_id'   =>  ['required', 'string', 'exists:books,id'],
        ];

        $messages = [
            'required'          =>  'Este campo é obrigatório!',
            'string'            =>  'Insira caracteres válidos!',
            'reader_id.exists'  =>  'Esse leitor não está cadastrado no sistema. Tente novamente.',
            'book_id.exists'    =>  'Esse livro não existe no arcevo. Tente novamente.',
            'in'                =>  'Selecione um dos valores pré-informados.',
        ];

        return $data->validate($fields, $messages);
   }

    /**
    * Get a validator for update.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function updateValidator($data)
    {
         $fields = [
             'status'    =>  ['required', Rule::in(['ATIVO', 'INATIVO'])],
         ];
 
         $messages = [
             'required'          =>  'Este campo é obrigatório!',
             'in'                =>  'Selecione um dos valores pré-informados.',
         ];
 
         return $data->validate($fields, $messages);
    }
}
