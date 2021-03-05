<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::paginate(5);
        // dd($teachers);
        return view('teachers.index', [
            'teachers'=> $teachers,
        ]);
    }
    public function addTeacher(Request $request)
    {
        $this->validate($request, [
            'f_name'=>'required',
            'l_name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'dob'=>'required',
        ]);

        $user = User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password), 
            'role'=>'teacher',
        ]);

        // foreach($request->phone_number as $phone)
        // {
        //     $phones = PhoneNumber::create([
        //         'phone_number'=>$phone,
        //         ]);
        // }
        Teacher::create([
            'f_name'=>$request->f_name,
            'l_name'=>$request->l_name,
            'user_id'=>$user->id,
            'dob'=>$request->dob,
        ]);

        return redirect()->route("teachers");        
    }

    public function updateTeacher(Request $request)
    {
        $this->validate($request,[
            'edit_f_name'=>'required',
            'edit_l_name'=>'required',
            'edit_dob'=>'required',
        ]);
        Teacher::where('id',$request->edit_id)->update([
            'f_name'=>$request->edit_f_name,
            'l_name'=>$request->edit_l_name,
            'dob'=>$request->edit_dob,
        ]);
        return redirect()->route("teachers");
    }

    public function deleteTeacher($id)
    {
        $teacher = Teacher::find($id);
        $user_id = $teacher->user_id;
        // $teacher->delete();
        User::find($user_id)->delete();
        return redirect()->route('teachers');
    }
}
