@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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

        
        <input class="form-control" type="password" name="password" placeholder="Your Password">
        <div>
            <label for="dob">Date of birth :</label>
            <input class="form-control" type="date" name="dob">
        </div>
        @error('dob')
            {{$message}}
        @enderror

        <input type="submit" value="Add Student" class="mt-2 btn btn-primary">
    </form>
    <div class="container">
   
        @if ($students->count())
            <table class="table table-dark">
            <thead>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>DOB</th>
            <th>Email</th>
            
            <!-- <th>Phone Number</th> -->
            <th>Operations</th>
            </thead>
            <tbody>
                @foreach($students as $key => $student)
                @if($student->user->role == 'student')
                    <tr>
                        <td id='id-{{$student->id}}'>{{$student->id}}</td>
                        <td id='f_name-{{$student->id}}'>{{$student->f_name}}</td>
                        <td id='l_name-{{$student->id}}'>{{$student->l_name}}</td>
                        <td id='dob-{{$student->id}}'>{{$student->dob}}</td>
                        <td id='email-{{$student->id}}'>{{$student->user->email}}</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="editRecord(<?php echo $student->id ?>)"> Edit </button>
                                </div>
                                <div class="col-sm-4 ml-4 text-right">
                                   
                                <a href="{{route('deleteStudent',[ $student->id])}}" class="btn btn-danger">Delete</a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
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
                            <form action="{{route('updateStudent')}}" method="POST" id="modal-form-id">
                            @csrf
                                <input class="form-control" type="hidden" id="edit_id" name="edit_id" value="{{$student->id}}">
                                <input class="form-control" type="text" id="edit_f_name" name="edit_f_name" placeholder="First Name">
                                @error('f_name')
                                    {{$message}}
                                @enderror
                                <input class="form-control" type="text" id="edit_l_name" name="edit_l_name" placeholder="Last Name">
                                @error('l_name')
                                    {{$message}}
                                @enderror                              
                                    <label for="dob">Date of birth :</label>
                                    <input class="form-control" id="edit_dob" type="date" name="edit_dob">
                                @error('dob')
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
           
            {{ $students->links() }}       
        @else
            <p>There is no student record to show.</p>
        @endif            
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection('content')
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>


<script>

        function createNewPhoneNumberField(){
            // let inputField = document.getElementById('phone_number')
            // let inputField = '<input class="col-4 form-control" type="tel" name="phone_number" placeholder="Your phone number"/>'

            let newInputField = document.createElement("INPUT")
            // newInputField.innerHTML = inputField
            newInputField.setAttribute('type', 'tel')
            newInputField.setAttribute('class', 'col-4 form-control')
            newInputField.setAttribute('name', 'phone_number[]')
            newInputField.setAttribute('placeholder', 'Your phone number')
            document.getElementById("phone_number_parent_div").appendChild(newInputField)
            
        }

        function createNewPhoneNumberFieldInEdit(){
            const div_with_input_and_del_icon = document.createElement('div');
            const _div = '<input type="text" class="form-control" name="edit_phone_number[]" placeholder="Phone Number"/><i class="fa fa-trash-o del-icon" style="font-size:40px;color:red;" onclick="deletePhoneNumber()"></i>'
            div_with_input_and_del_icon.innerHTML = _div

            const parent_div = document.getElementById('edit_phone_number_parent_div');

            parent_div.appendChild(div_with_input_and_del_icon);
        
        }

        function deleteRecord(id){
            alert('this id is going to be deleted ', id)
        }

        function editRecord(std_id){
            document.getElementById('edit_f_name').value = document.getElementById('f_name-'+std_id).innerHTML
            document.getElementById('edit_l_name').value = document.getElementById('l_name-'+std_id).innerHTML
            document.getElementById('edit_dob').value = document.getElementById('dob-'+std_id).innerHTML



            // const numbers = document.getElementsByName('phone-numbers-' + std_id).length;
            // var i;
            // for (i = 0; i < numbers; i++) {
            //     const div_with_input_and_del_icon = document.createElement('div');
            //     const _div = '<input type="text" class="form-control" name="edit_phone_number[]" value="'+document.getElementById((i+1)+'-'+std_id).innerHTML+'" placeholder="Phone Number"/><i class="fa fa-trash-o del-icon" style="font-size:40px;color:red;" onclick="deletePhoneNumber()"></i>'
            //     div_with_input_and_del_icon.innerHTML = _div

            //     const parent_div = document.getElementById('edit_phone_number_parent_div');

            //     parent_div.appendChild(div_with_input_and_del_icon);
            // }
        }

        function saveChanges(url){
            // alert(url);
            // let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let request = new XMLHttpRequest();
            request.open('POST', url);
            let myForm = document.getElementById('modal-form-id');
            let formData = new FormData(myForm);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.status ===200 && request.readyState==4){
                    console.log(request.responseText);

                }
            };

        }

        function deletePhoneNumber(){
        var del_icons = document.getElementsByClassName('del-icon');
            var arr = [].slice.call(del_icons);


        }
        document.addEventListener('click', function(e) {
            let element = e.target;
            if(element.classList.contains('del-icon')) {
                console.log(element, "this is is")
                let phoneNum = element.parentElement;
                if(phoneNum.parentElement.childElementCount == 2){
                    phoneNum.remove();
                    document.getElementsByClassName('del-icon')[0].remove();
                }else if(phoneNum.parentElement.childElementCount == 1){
                    // phoneNum.remove();
                    document.getElementsByClassName('del-icon')[0].remove();
                }
                else
                    phoneNum.remove();
            }
        });

        // function closeModel(){
        //     document.getElementById('edit_phone_number_parent_div').innerHTML=""
        // }

</script>