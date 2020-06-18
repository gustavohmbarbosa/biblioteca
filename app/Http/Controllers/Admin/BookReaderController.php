<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //For queries
use App\Reader;
use App\Book;
use App\BookReader;

class BookReaderController extends Controller
{
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
        ->select('book_reader.*', 'books.title', 'books.subtitle', 'readers.name', 'readers.year', 'readers.class', 'readers.course')->get();
        
        return view('admin.loan.index', compact('loans'));
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

        return view('admin.loan.create', compact('readers', 'books'));
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

        $reader = Reader::findOrFail($data['reader_id']);
        $book = Book::findOrFail($data['book_id']);

        $reader->addBook($book, $data);

        return redirect()->route('admin.loan.index');
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
        ->select('book_reader.*', 'books.title', 'books.subtitle', 'readers.name', 'readers.year', 'readers.class', 'readers.course')->get()->first();

        return view('admin.loan.main', compact('loan'));
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

        $loan = BookReader::findOrfail($id);
        $loan->update($data);

        return redirect()->route('admin.loan.show', compact('loan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
