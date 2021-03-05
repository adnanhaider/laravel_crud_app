@extends('layouts.app')

@section('content')
<div class="col-md-12 d-flex justify-content-center">
    <form action="{{ route('login') }}" method="POST">
    @csrf
       
        <div class="mb-4 mt-4 row">
            <div class="col-md-12">
                <h3 for="Registeration-form" class="float-left">Login</h3>
            </div>        
        </div>
        @if(session('status'))
            <p class="text-danger"> {{session('status')}} </p>
        @endif
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
        <div class="mb-4">
            <div>
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember">Remember Me</label>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>

@endsection