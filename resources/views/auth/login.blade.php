@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <h1 class="my-4" style="color: #0056b3;">Login</h1> <!-- Cambiato il colore -->

    <div class="card" style="background-color: #fefcff;">
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" style="color: #0056b3;">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password" style="color: #0056b3;">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember" style="color: #0056b3;">
                            Remember Me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Login</button> <!-- Cambiato il colore -->
            </form>

            <div class="mt-3">
                <a href="{{ route('password.request') }}" style="color: #0056b3;">Forgot Your Password?</a>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection