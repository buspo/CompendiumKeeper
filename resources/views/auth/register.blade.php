@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="my-4 title-blue">Register</h1 >

            <div class="card" style="background-color: #fefcff;">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username" style="color: #0056b3;">Username</label>
                            <input id="username" type="text" value="{{ $username ?? old('username') }}}" class="form-control @error('username') is-invalid @enderror" name="username" required autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" style="color: #0056b3;">Email</label>
                            <input id="email" type="email" value="{{ $email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" style="color: #0056b3;">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" style="color: #0056b3;">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-blue">Register</button >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection