<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $loans = BookReader::all()->toArray();

        foreach($loans as $key => $loan){
            //Search reader and book
            $reader = Reader::findOrFail($loan['reader_id']);
            $book = Book::findOrFail($loan['book_id']);

            //add reader and book to array
            $loans[$key]['reader_name'] = $reader->name;
            $loans[$key]['book_title'] = $book->title;
        }

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
        //
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
        //
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
