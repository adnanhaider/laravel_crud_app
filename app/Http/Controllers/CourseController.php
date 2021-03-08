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
            'course_name'=>'required',
            'teacher_id'=>'required',
            'credit_hours'=>'required|numeric'
        ]);
        
        $course = Course::create([
            'course_name'=>$request->course_name,
            'teacher_id'=>$request->teacher_id,
            'credit_hours'=>$request->credit_hours
        ]);
         return redirect()->route("courses");
    }

    public function updateCourse(Request $request)
    {
        $this->validate($request,[
            'edit_course_name'=>'required',
            'edit_teacher_id'=>'required',
            'edit_credit_hours'=>'required',
        ]);

        Course::where('id',$request->edit_id)->update([
            'course_name'=>$request->edit_course_name,
            'teacher_id'=>$request->edit_teacher_id,
            'credit_hours'=>$request->edit_credit_hours,
        ]);
        return redirect()->route("courses");
    }
    public function deleteCourse($id){
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('courses');

    }
}
