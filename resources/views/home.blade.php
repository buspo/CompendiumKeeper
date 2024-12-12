@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
					
					<!-- Sezione per aprire i personaggi -->
                    <div class="mt-4">
                        <h3>I tuoi Personaggi</h3>
                        <p>Puoi gestire i tuoi personaggi qui:</p>
                        <a href="{{ route('characters.index') }}" class="btn btn-primary">Apri Personaggi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection