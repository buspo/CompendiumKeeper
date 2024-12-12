@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">{{ __('Altre Azioni') }}</div>
                <div class="card-body">
                    <h5 class="card-title">Gestisci il tuo Gioco</h5>
 <p class="card-text">Accedi a tutte le funzionalità per gestire i tuoi personaggi e le tue avventure.</p>
                    <div class="text-center">
                        <a href="{{ route('characters.create') }}" class="btn btn-warning">Crea Nuovo Personaggio</a>
                        <a href="{{ route('characters.index') }}" class="btn btn-info">Visualizza Personaggi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection