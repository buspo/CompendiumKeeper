@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <h1 class="my-4 title-blue">Verify Your Email Address</h1> <!-- Colore uniforme -->

    <div class="card mb-4" style="background-color: #ffffff; border: 1px solid #0056b3;"> <!-- Sfondo e bordo uniforme -->
        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-info" role="alert" >
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <p>Please check your email for a verification link before continuing.</p>
            <p>If you did not receive the email,</p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-blue">click here to request another</button >
            </form>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection