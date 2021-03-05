@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container mt-4">
    Courses:
    <form action="{{ route('courses') }}" method="POST">
    @csrf
        <input class="form-control" type="text" name="name" placeholder="Course Name">
        @error('name')
            {{$message}}
        @enderror

        <select name="teacher_id" class="form-control">
            <option disabled selected value="ST">Select Teacher</option>
            @foreach($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->f_name.' '. $teacher->l_name}}</option>
            @endforeach
            </select>

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
            <th>Teacher Email</th>
            <th>Credit Hours</th>

            <!-- <th>Phone Number</th> -->
            <th>Operations</th>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td >{{$course->id}}</td>
                        <td >{{$course->name}}</td>
                        <td >{{$course->teacher->f_name.' '. $course->teacher->l_name}}</td>
                        <td >{{$course->teacher->user->email}}</td>
                        <td class ="name">{{$course->credit_hours}}</td>
                        <!-- <td class="teacher_id">{{$course->teacher_id}}</td> -->
                        <td>
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <div class="previous">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="editRecord(<?php echo $course->id ?>)"> Edit </button>
                                    </div>
                                </div>
                                <div class="col-sm-4 ml-4 text-right">
                                    <div class="next">
                                        <button type="button" onclick="deleteRecord(<?php echo $course->id ?>)" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
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
