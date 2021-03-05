<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <!-- <link rel="stylesheet" href=""> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Learning | Laravel</title>
</head>
<body class="bg-dark text-light">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
      </li>
      @auth
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('students') }}">Student</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('teachers') }}">Teachers</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('courses') }}">Courses</span></a>
      </li>
      @endauth
    </ul>
    <ul class="navbar-nav ml-auto">
    @auth
        <li class="nav-item active">
          <a class="nav-link" href="#">{{ auth()->user()->name}}</a>
        </li>
        <li class="nav-item active">
        <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
          <button type="submit" class="btn btn-link text-dark">Logout </button>
        </form>
        </li>
     <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
      @endauth
      @guest
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('register') }}">Register</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('login') }}">Login</span></a>
        </li>
      @endguest
    </ul>
  </div>
</nav>
    @yield('content')
</body>
</html>