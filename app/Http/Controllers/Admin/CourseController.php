<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Messages;
use App\Course;

class CourseController extends Controller
{
    use Messages;

    private $course;

    public function __construct(Course $course){

        $this->course = $course;

    }

    /**
     * Display a list of courses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->course->all(['id', 'name']);

        return response()->json(['data' => $courses]);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        $this->course->create($data);

        return $this->message("Curso criado com sucesso!", 201);
    }

    /**
     * Display the specified course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->course->find($id);

        if(is_null($course)){
            return $this->errorMessage("Curso não encontrado.");
        }

        return response()->json(['data' => $course]);
    }

    /**
     * Update the specified course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = $this->course->find($id);

        if(is_null($course)){
            return $this->errorMessage("Curso não encontrado.");
        }

        $data = $this->validator($request);
        $course->update($data);

        return $this->message("Cuso atualizado com sucesso!");
    }

    /**
     * Remove the specified course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = $this->course->find($id);

        if(is_null($course)){
            return $this->errorMessage("Curso não encontrado.");
        }

        $course->delete();

        return $this->message('Curso de ' . $course->name . ' deletado com sucesso!');
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
            'name' => ['required', 'string', 'max:190'],
        ];

        $messages = [
            'required'  =>  'Este campo é obrigatório!',
            'string'    =>  'Insira caracteres válidos!',
            'max'       =>  'Campo deve ter no máximo :max caracteres.',
        ];

        return $data->validate($fields, $messages);
   }
}
