@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <h1 class="my-4" style="color: #0056b3;">Register</h1> <!-- Cambiato il colore -->

    <div class="card" style="background-color: #fefcff;">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="username" style="color: #0056b3;">Username</label>
                    <input id="username" type="text" class="form-control" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email" style="color: #0056b3;">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password" style="color: #0056b3;">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

 <div class="form-group">
                    <label for="password_confirmation" style="color: #0056b3;">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-success">Register</button> <!-- Cambiato il colore -->
            </form>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection