@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="my-4" style="color: #003366;">Characters</h1>

    <div class="mb-3">
        <a href="{{ route('characters.create') }}" class="btn btn-warning mr-2 mb-1">Create New Character with Template</a>
        <button class="btn btn-secondary mb-1" type="button" data-toggle="modal" data-target="#uploadModal">Upload Character from JSON</button>
    </div>

    <!-- Modal for uploading JSON file -->

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Character JSON</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="sheet_file">Select JSON File</label>
                            <input type="file" class="form-control-file" id="sheet_file" name="sheet_file" accept=".json" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="uploadCharacter()">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <div id="message"></div>

    <div class="list-group">
        @foreach($characters as $character)
            <div class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #fefcff;">
                <div>
                    <h5 class="mb-1" style="color: #003366;">{{ $character->charname ?? "Unnamed" }}</h5>
                    <small>Last modified: {{ $character->updated_at->format('d/m/Y H:i') }}</small>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('characters.show', $character) }}" class="btn btn-info btn-sm mr-1 material-icons">download</a>
                    <a href="{{ route('characters.edit', $character) }}" class="btn btn-warning btn-sm mr-1 material-icons">edit</a>
                    <form action="{{ route('characters.destroy', $character) }}" 
                        method="DELETE" 
                        style="display ```blade
                        :inline;"
                        onsubmit="return confirm('Are you sure you want to delete this character?');">
                        <button type="submit" class="btn btn-danger btn-sm material-icons">delete</button>
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

@section('script')

<script>

function uploadCharacter() {

    const formData = new FormData(document.getElementById('uploadForm'));
    $.ajax({
        type: "POST",
        url: "/characters/upload", // Adjust the URL to your route
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            alert(data.message);
            location.href = "/characters"; // Redirect or update the UI as needed
        },
        error: function (error) {
            alert("Error uploading file: " + error.responseText);
        }
    });
    
}

</script>

@endsection