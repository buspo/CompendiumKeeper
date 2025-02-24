<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Compendium Keeper</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #0056b3;
        }
        .navbar-brand img {
            max-height: 40px;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-info {
            background-color: #007bff;
        }
        .btn-blue {
            background-color: #003366;
            color: white;
        }
        .btn-blue:hover, .btn-blue:focus, .btn-blue:active, .btn-blue.active, .open>.dropdown-toggle.btn-blue {
            color: #fff;
            background-color:rgba(0, 51, 102, 0.7);
            border-color:rgba(0, 51, 102, 0.3);
        }
        .title-blue {
            color: #003366;
        }
        .btn-blue-1 {
            background-color: #0D47A1;
            color: white;
        }
        .btn-blue-1:hover, .btn-blue-1:focus, .btn-blue-1:active, .btn-blue-1.active, .open>.dropdown-toggle.btn-blue-1 {
            color: #fff;
            background-color:rgba(13, 72, 161, 0.7);
            border-color:rgba(13, 72, 161, 0.3);
        }
        .btn-blue-2 {
            background-color: #1976D2;
            color: white;
        }
        .btn-blue-2:hover, .btn-blue-2:focus, .btn-blue-2:active, .btn-blue-2.active, .open>.dropdown-toggle.btn-blue-2 {
            color: #fff;
            background-color:rgba(25, 118, 210, 0.7);
            border-color:rgba(25, 118, 210, 0.3);
        }
        .btn-blue-3 {
            background-color: #2196F3;
            color: white;
        }
        .btn-blue-3:hover, .btn-blue-3:focus, .btn-blue-3:active, .btn-blue-3.active, .open>.dropdown-toggle.btn-blue-3 {
            color: #fff;
            background-color:rgba(33, 149, 243, 0.7);
            border-color:rgba(33, 149, 243, 0.3);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('CompendiumKeeper_extend.png') }}" alt="Logo" class="img-fluid"> 
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" style="color: #ffffff;">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}" style="color: #ffffff;">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" style="color: #ffffff;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.edit') }}" style="color: #ffffff;">Setting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ffffff;">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>

    <div class="container mt-3">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('script')
</body>
</html>