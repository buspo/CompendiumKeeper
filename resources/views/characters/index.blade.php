@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Personaggi</h1>

    <a href="{{ route('characters.create') }}" class="btn btn-sm">Crea personaggio</a>
    <div id="message"></div>

    <ul>
        @foreach($characters as $character)
                {{ $character->name }}
                <a href="{{ route('characters.show', $character) }}" class="btn btn-info btn-sm">Scarica Personaggio</a>
                <a href="{{ route('characters.edit', $character) }}" class="btn btn-info btn-sm">Modifica Personaggio</a>
                <form action="{{ route('characters.destroy', $character) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                </form>
        @endforeach
    </ul>
</div>
@endsection