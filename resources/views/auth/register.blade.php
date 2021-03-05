@extends('layouts.app')

@section('content')
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

<div class="col-md-12 d-flex justify-content-center">
    <form action="{{ route('register') }}" method="POST">
    @csrf
        <div class="mb-4 mt-4 row">
            <div class="col-md-12">
                <h3 for="Registeration-form" class="float-left">Registeration Form</h3>
            </div>
        </div>
        <div class="mb-4 mt-4 row">
            <div class="col-md-4">

                <label for="name" class="float-left">Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="name" id="name" placeholder="Your name" class="p-4 rounded-lg" value='{{old("name")}}' >
            </div>
        
        </div>
        @error('name')
            <div class=" mt-2 mb-2 text-danger text-sm">
                {{ $message }}
            </div>
        @enderror


        <div class="mb-4 row">
            <div class="col-md-4">

                <label for="email" class="float-left">Email</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="email" id="email" placeholder="Your email" class="p-4 rounded-lg" value='{{old("email")}}' >
            </div>
        </div>
        @error('email')
            <div class=" mt-2 mb-2 text-danger text-sm">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-4 mt-4 row">
            <div class="col-md-4">

                <label for="role" class="float-left">Role</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="role" id="role" placeholder="Role" class="p-4 rounded-lg" value='{{old("role")}}' >
            </div>
        
        </div>
        @error('role')
            <div class=" mt-2 mb-2 text-danger text-sm">
                {{ $message }}
            </div>
        @enderror
        
        <div class="mb-4 row">
            <div class="col-md-4">
                <label for="password" class="float-left">Password</label>
            </div>
            <div class="col-md-8">
                <input type="password" name="password" id="password" placeholder="Your password" class="p-4 rounded-lg" value='' >
            </div>
        
        </div>
        @error('password')
            <div class=" mt-2 mb-2 text-danger text-sm">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-4 row">
            <div class="col-md-4">

                <label for="password_confirmation" class="float-left">Confirm Password</label>
            </div>
            <div class="col-md-8">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" class="p-4 rounded-lg" value='' >
            </div>
        
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>
@endsection('content')
