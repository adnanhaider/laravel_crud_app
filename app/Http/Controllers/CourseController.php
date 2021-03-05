<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {   
        $teachers = Teacher::with(['user'])->get();
        $courses = Course::with(['teacher'])->paginate(5);
        // dd($courses);
        return view('courses.index',[
            'courses'=>$courses,
            'teachers'=> $teachers,
        ]);
       
    }
    public function addCourse(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'teacher_id'=>'required',
            'credit_hours'=>'required|numeric'
        ]);
        
        $course = Course::create([
            'name'=>$request->name,
            'teacher_id'=>$request->teacher_id,
            'credit_hours'=>$request->credit_hours
        ]);
         return redirect()->route("courses");
    }
}
