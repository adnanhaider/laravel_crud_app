@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container mt-4">
    Students:
    <form action="{{ route('students') }}" method="POST">
    @csrf
        <input class="form-control" type="text" name="f_name" placeholder="First Name">
        @error('f_name')
            {{$message}}
        @enderror
        <input class="form-control" type="text" name="l_name" placeholder="Last Name">
        @error('l_name')
            {{$message}}
        @enderror
        <input class="form-control" type="email" name="email" placeholder="Your email">
        @error('email')
            {{$message}}
        @enderror

        <div id="phone_number_parent_div" class="ml-auto mr-2 row">
            <input class="col-4 form-control" type="tel" name="phone_number[]" placeholder="Your phone number">
            <!-- <span>&#43;</span> -->
            <button type="button" class="btn btn-success" onclick="createNewPhoneNumberField()"><i class="col-4 fas fa-plus">Add More</i></button>
        </div>
        @error('phone_number')
            {{$message}}
        @enderror
        <input class="form-control" type="password" name="password" placeholder="Your Password">
        <div>
            <label for="dob">Date of birth :</label>
            <input class="form-control" type="date" name="dob">
        </div>
        @error('dob')
            {{$message}}
        @enderror

        <input type="submit" value="Add Teacher" class="mt-2 btn btn-primary">
    </form>
    
    <div class="container">
   
   @if ($students->count())
       <table class="table table-dark">
       <thead>
       <th>User Id</th>
       <th>Student Id</th>
       <th>First Name</th>
       <th>Last Name</th>
       <th>DOB</th>
       <th>Email</th>
       <th>Phone Number</th>
       <th>Operations</th>
       </thead>
       <tbody>
           @foreach($users as $user)
           @if($user->role == 'student')
               <tr>
                   <td id='id-{{$user->id}}' class ="id" >{{$user->id}}</td>
                   <td id='id-{{$students[0]->id}}' class ="id" >{{$students[0]->user_id}}</td>
                   <td id='f_name-{{$user->id}}' class ="f_name">{{$user->f_name}}</td>
                   <td id='l_name-{{$user->id}}' class ="l_name">{{$user->l_name}}</td>
                   <td id='dob-{{$user->id}}' class ="dob">{{$user->dob}}</td>
                   <td id='email-{{$user->id}}' class ="email">{{$user->email}}</td>
                   @for($i=0; $i<$user->getPhoneNumber->count(); $i++)
                       <td id='{{$i+1}}-{{$user->id}}' name="phone-numbers-{{$user->id}}">{{$user->getPhoneNumber[$i]['phone_number']}}</td>
                   @endfor
                   <td>
                       <div class="row">
                           <div class="col-sm-4 text-left">
                               <div class="previous">
                                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="editRecord(<?php echo $user->id ?>)"> Edit </button>
                               </div>
                           </div>
                           <div class="col-sm-4 ml-4 text-right">
                               <div class="next">
                                   <button type="button" onclick="deleteRecord(<?php echo $user->id ?>)" class="btn btn-danger">Delete</button>
                               </div>
                           </div>
                       </div>
                   </td>
               </tr>
            @endif
               <div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Teacher</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModel()">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="container modal-body text-dark">
                       <form action="" method="POST" id="modal-form-id">
                       @csrf
                           <input class="form-control" type="text" id="edit_f_name" name="edit_f_name" placeholder="First Name">
                           @error('f_name')
                               {{$message}}
                           @enderror
                           <input class="form-control" type="text" id="edit_l_name" name="edit_l_name" placeholder="Last Name">
                           @error('l_name')
                               {{$message}}
                           @enderror
                           <input class="form-control" type="email" id="edit_email" name="edit_email" placeholder="Your email">
                           @error('email')
                               {{$message}}
                           @enderror

                           <button type="button" class="btn btn-success" onclick="createNewPhoneNumberFieldInEdit()"><i class="col-4 fas fa-plus">Add More</i></button>
                           <div id="edit_phone_number_parent_div" class="ml-auto mr-2 row">
                           </div>
                           @error('phone_number')
                               {{$message}}
                           @enderror
                           <input class="form-control" type="password" name="edit_password" placeholder="Your Password">
                           <div>
                               <label for="dob">Date of birth :</label>
                               <input class="form-control" id="edit_dob" type="date" name="edit_dob">
                           </div>
                           @error('dob')
                               {{$message}}
                           @enderror
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModel()">Close</button>
                       <button type="button" class="btn btn-primary" onclick="closeAndModel('a')">Save changes</button>
                   </div>
                   </div>
               </div>
           </div>  
           @endforeach
           
       </tbody>
       </table>
      
       {{ $users->links() }}       
   @else
       <p>There is no teacher record to show yet.</p>
   @endif            
</div>




</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection('content')
