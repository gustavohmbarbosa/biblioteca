<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
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
    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        $this->course->create($data);

        return $this->message("Course created successfully", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->course->find($id);

        if(is_null($course)){
            return $this->message("Course not found", 404, true);
        }

        return response()->json(['data' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $course = $this->course->find($id);

        if(is_null($course)){
            return $this->message("Course not found", 404, true);
        }

        $data = $request->validated();
        $course->update($data);

        return $this->message('Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = $this->course->find($id);

        if(is_null($course)){
            return $this->message("Course not found", 404, true);
        }

        $course->delete();

        return $this->message('Course "' . $course->name . '" deleted successfully!');
    }
}
