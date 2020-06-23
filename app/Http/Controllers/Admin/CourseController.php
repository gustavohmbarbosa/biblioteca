<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    private $course;
    
    public function __construct(Course $course){

        $this->course = $course;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->course->all(['id', 'name']);

        return response()->json(['data' => $courses]);
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

        try {

            $this->course->create($data);

            $message = [
                'content' => "Curso criado com sucesso!",
                'type'    => "success"
            ];

        } catch (\Exception $e) {

            $message = [
                'content' => "Falha ao criar curso!",
                'type'    => "danger"
            ];

        }

        // echo json_encode($message);

        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = ['data' => $this->course->findOrFail($id)];

        return response()->json($course);
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
        $course = $this->course->findOrFail($id);

        try {

            $course->update($data);

            $message = [
                'content' => "Curso atualizado com sucesso!",
                'type'    => "success"
            ];

        } catch (\Exception $e) {

            $message = [
                'content' => "Falha ao atualizar curso!",
                'type'    => "danger"
            ];

        }

        // echo json_encode($message);

        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $course = $this->course->findOrFail($id);
            $course->delete();

            return response()->json(['message' => 'Curso ' . $course->name . ' deletado com sucesso!']);

        } catch (\Exception $e) {
            
            return response()->json(['message' => 'Falha ao deletar curso!'], 1012);

        }
    }
}
