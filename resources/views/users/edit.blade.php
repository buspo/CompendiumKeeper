@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #003366;">User Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
                    <label for="name" style="color: #003366;">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" style="color: #003366;">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password" style="color: #003366;">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" style="color: #003366;">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter new password">
                </div>

                <button type="submit" class="btn btn-warning">Update Profile</button>
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
