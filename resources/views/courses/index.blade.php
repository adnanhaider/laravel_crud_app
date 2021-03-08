@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container mt-4">
    Courses:
    <form action="{{ route('courses') }}" method="POST">
    @csrf
        <input class="form-control" type="text" name="course_name" placeholder="Course Name">
        @error('name')
            {{$message}}
        @enderror

        <select name="teacher_id" class="form-control">
            <option disabled selected value="ST">Select Teacher</option>
            @foreach($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->f_name.' '. $teacher->l_name}}</option>
            @endforeach
            </select>
            @error('teacher_id')
                {{$message}}
            @enderror

        <!-- <input class="form-control" type="text" name="teacher_id" placeholder="Teacher id"> -->
        @error('name')
            {{$message}}
        @enderror

        <input class="form-control" type="number" name="credit_hours" value="3" placeholder="Credit Hours">
        @error('credit_hours')
            {{$message}}
        @enderror
        <input type="submit" value="Add Course" class="mt-2 btn btn-primary">
    </form>
     <div class="container">
   
        @if ($courses->count())
            <table class="table table-dark">
            <thead>
            <th>id</th>
            <th>Course Name</th>
            <th>Teacher Name</th>
            <!-- <th>Teacher Email</th> -->
            <th>Credit Hours</th>

            <!-- <th>Phone Number</th> -->
            <th>Operations</th>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td >{{$course->id}}</td>
                        <td id="course_name-{{$course->id}}">{{$course->course_name}}</td>
                        <td id="teacher_id-{{$course->id}}">{{$course->teacher->f_name.' '. $course->teacher->l_name}}</td>
                        <!-- <td id="teacher_email">{{$course->teacher->user->email}}</td> -->
                        <td id="credit_hours-{{$course->id}}" >{{$course->credit_hours}}</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <div class="previous">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="editRecord(<?php echo $course->id ?>)"> Edit </button>
                                    </div>
                                </div>
                                <div class="col-sm-4 ml-4 text-right">
                                    <div class="next">
                                        <a href="{{route('deleteCourse',[ $course->id])}}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="container modal-body text-dark">
                            <form action="{{route('updateCourse')}}" method="GET" id="modal-form-id">
                            @csrf
                                <input class="form-control" type="hidden" id="edit_id" name="edit_id" value="{{$course->id}}">
                                <input class="form-control" type="text" id="edit_course_name" name="edit_course_name" placeholder="Course Name">
                                @error('edit_course_name')
                                    {{$message}}
                                @enderror
                                <input class="form-control" type="text" id="edit_credit_hours" name="edit_credit_hours" placeholder="Credit Hours">
                                @error('edit_credit_hours')
                                    {{$message}}
                                @enderror       
                                
                                <select id="edit_teacher_id" name="edit_teacher_id" class="form-control">
                                    <option disabled selected value="ST">Select Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->f_name.' '. $teacher->l_name}}</option>
                                    @endforeach
                                </select>
                                @error('edit_teacher_id')
                                    {{$message}}
                                @enderror
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>  
                            </form>
                        </div>
                     </div>
                    </div>
                </div>
                @endforeach
            </tbody>
            </table>
           
            {{ $courses->links() }}       
        @else
            <p>No course record to show.</p>
        @endif            
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection('content')

<script>


function editRecord(course_id){
    // console.log(course_id)
    document.getElementById('edit_id').value = course_id;
    document.getElementById('edit_course_name').value = document.getElementById('course_name-'+course_id).innerHTML
    document.getElementById('edit_credit_hours').value = document.getElementById('credit_hours-'+course_id).innerHTML
    // var e = document.getElementById('teacher_id-'+course_id)
    const opt = document.querySelector('#teacher_id-'+course_id+' option:checked');
    // var teacher_full_name = e.options[e.selectedIndex].text;
    // console.log(teacher_full_name,' this was teacher_full_name')
    document.getElementById('edit_teacher_id').value = opt.text;
}


</script>
