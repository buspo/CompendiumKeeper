@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="my-4">Characters</h1>

    <div class="mb-3">
        <a href="{{ route('characters.create') }}" class="btn btn-primary">Create Character</a>
    </div>

    <div id="message"></div>

    <div class="list-group">
        @foreach($characters as $character)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $character->charname ?? "Unnamed" }}</h5>
                    <small>Last modified: {{ $character->updated_at->format('d/m/Y H:i') }}</small>
                </div>
                <div>
                    <a href="{{ route('characters.show', $character) }}" class="btn btn-info btn-sm">Download</a>
                    <a href="{{ route('characters.edit', $character) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('characters.destroy', $character) }}" 
                        method="DELETE" 
                        style="display:inline;"
                        onsubmit="return confirm('Are you sure you want to delete this character?');">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    @if($characters->isEmpty())
        <div class="alert alert-warning mt-4" role="alert">
            You haven't created any characters yet.
        </div>
    @endif
</div>

@endsection