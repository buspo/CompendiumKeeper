@extends('layouts.app')

@section('content')
    <h1>I tuoi personaggi</h1>
    <a href="{{ route('characters.create') }}">Crea un nuovo personaggio</a>
    <ul>
        @foreach($characters as $character)
            <li>{{ $character->name }} - {{ $character->class }} (Livello: {{ $character->level }})</li>
        @endforeach
    </ul>
@endsection