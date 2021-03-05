<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller{
    
    public function __contruct()
    {
        return $this->middleware(['auth']);
    }
    public function index()
    {   
        $students = Student::paginate(5);
        
        return view('students.index', [
            'students'=> $students,
            ]);
    }
    public function addStudent(Request $request)
    {
        $this->validate($request,[
            'f_name'=>'required',
            'l_name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'dob'=>'required',
        ]);
        $user = User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'student',
        ]);

        Student::create([
            'f_name'=>$request->f_name,
            'l_name'=>$request->l_name,
            'user_id'=>$user->id,
            'dob'=>$request->dob,
        ]);
        
        return redirect()->route("students");
    }

    public function updateStudent(Request $request)
    {
        $this->validate($request,[
            'edit_f_name'=>'required',
            'edit_l_name'=>'required',
            'edit_dob'=>'required',
        ]);
            // Student::updateData($request);
        Student::where('id',$request->edit_id)->update([
            'f_name'=>$request->edit_f_name,
            'l_name'=>$request->edit_l_name,
            'dob'=>$request->edit_dob,
        ]);
        return redirect()->route("students");
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);
        $user_id = $student->user_id;
        // $student->delete();
        User::find($user_id)->delete();
        return redirect()->route('students');

    }
}
