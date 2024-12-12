@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="my-4">Personaggi</h1>

    <div class="mb-3">
        <a href="{{ route('characters.create') }}" class="btn btn-primary">Crea Personaggio</a>
    </div>

    <div id="message"></div>

    <div class="list-group">
        @foreach($characters as $character)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $character->charname ?? "Senza nome" }}</h5>
                    <small>Ultima modifica: {{ $character->updated_at->format('d/m/Y H:i') }}</small>
                </div>
                <div>
                    <a href="{{ route('characters.show', $character) }}" class="btn btn-info btn-sm">Scarica</a>
                    <a href="{{ route('characters.edit', $character) }}" class="btn btn-warning btn-sm">Modifica</a>
                    <form action="{{ route('characters.destroy', $character) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    @if($characters->isEmpty())
        <div class="alert alert-warning mt-4" role="alert">
            Non hai ancora creato alcun personaggio.
        </div>
    @endif
</div>

@endsection