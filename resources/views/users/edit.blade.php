@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #0056b3;">User  Profile</h1> <!-- Cambiato il colore -->

    @if(session('success'))
        <div class="alert alert-info">{{ session('success') }}</div> <!-- Cambiato il colore -->
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('users.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="username" style="color: #0056b3;">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username', auth()->user()->username) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" style="color: #0056b3;">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password" style="color: #0056b3;">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" style="color: #0056b3;">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter new password">
                </div>

                <button type="submit" class="btn btn-success">Update Profile</button> <!-- Cambiato il colore -->
            </form>

            <form method="POST" action="{{ route('users.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account?');" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
</div>
@endsection