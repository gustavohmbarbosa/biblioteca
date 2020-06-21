<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReaderRequest;
use App\Reader;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = ['data' => Reader::paginate(10)];

        return response()->json($readers);
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
    public function store(ReaderRequest $request)
    {
        try{

            $data = $request->all();
            $reader = Reader::create($data);

            return response()->json(['menssage' => 'Leitor criado com sucesso!'], 201);

        } catch (\Exception $error){

            return response()->json(['menssage' => 'Falha ao realizar a operação!'], 1010);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reader =['data' => Reader::findOrFail($id)];

        return response()->json($reader);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReaderRequest $request, $id)
    {
        $data = $request->all();

        $reader = Reader::findOrFail($id);
        $reader->update($data);

        //return redirect()->route('admin.reader.show', compact('reader'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reader = Reader::findOrFail($id);
        $reader->delete();

        //return redirect()->route('admin.reader.index');
    }
}
