@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="my-4" style="color: #003366;">Characters</h1>

    <div class="mb-3">
        <a href="{{ route('characters.create') }}" class="btn btn-warning mr-2 mb-1">Create New Character with Template</a>
        <button class="btn btn-secondary mb-1" type="button" data-toggle="modal" data-target="#uploadModal">Upload Character from JSON</button>
    </div>

    <div id="message"></div>

    <div class="list-group">
        @foreach($sheet as $character)
            <div class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #fefcff;">
                <div>
                    <h5 class="mb-1" style="color: #003366;">{{ $character->charname ?? "Unnamed" }}</h5>
                    <small>Last modified: {{ $character->updated_at->format('d/m/Y H:i') }}</small>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    @if($character->user_id == Auth::user()->id)
                    <button class="btn btn-info btn-sm mr-1 material-icons" type="button" data-id="{{ $character->id }}" data-toggle="modal" data-target="#shareModal">share</button>
                    <a href="{{ route('characters.edit', $character) }}" class="btn btn-warning btn-sm mr-1 material-icons">edit</a>
                    @else
                    <a href="{{ route('characters.view', $character) }}" class="btn btn-warning btn-sm mr-1 material-icons">visibility</a>
                    @endif
                    <a href="{{ route('characters.show', $character) }}" class="btn btn-info btn-sm mr-1 material-icons">download</a>
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

    @if($sheet->isEmpty())
        <div class="alert alert-warning mt-4" role="alert">
            You haven't created any characters yet.
        </div>
    @endif

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
                        <label for="sheet_file" class="font-weight-bold mb-2">Select JSON File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="sheet_file" name="sheet_file" accept=".json" required>
                            <label class="custom-file-label" for="sheet_file">Choose file...</label>
                        </div>
                        <small class="form-text text-muted mt-2">Select a JSON file with your character data</small>
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

<!-- Modal for share character -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share your character</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="shareForm">
                    @csrf
                    <div class="form-group">
                        <label for="username" class="font-weight-bold mb-2">Username of player</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons" style="font-size: 18px;">person</i>
                                </span>
                            </div>
                            <input type="text" 
                                   class="form-control" 
                                   id="username" 
                                   name="username" 
                                   placeholder="Enter username"
                                   required>
                        </div>
                        <small class="form-text text-muted">Enter the username of the player you want to share with</small>
                        <input type="hidden" id="character_id" name="character_id" required>
                    </div>
                </form>
                
                <div class="mt-4">
                    <h6 class="font-weight-bold">Users with access:</h6>
                    <ul id="sharedUsersList" class="list-group">
                        <!-- La lista verrà popolata via JavaScript -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="shareCharacter()">Share</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>

$("#shareModal").on('show.bs.modal', function (e){
    const button = e.relatedTarget;
    const value = button.getAttribute("data-id");
    $("#character_id").val(value);

    loadSharedUsers(value);
});

$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

function loadSharedUsers(characterId) {
    $.ajax({
        type: "GET",
        url: `/characters/${characterId}/shared-users`,
        success: function(users) {
            const usersList = $('#sharedUsersList');
            usersList.empty();
            
            users.forEach(user => {
                usersList.append(`
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ${user.username}
                        <button class="btn btn-sm text-danger material-icons" 
                                onclick="removeShare(${user.id}, ${characterId})">
                            delete
                        </button>
                    </li>
                `);
            });
        },
        error: function(error) {
            alert("Errore nel caricamento degli utenti");
        }
    });
}

function removeShare(userId, characterId) {
    if (!confirm('Sei sicuro di voler rimuovere questa condivisione?')) {
        console.log("esco");
        return;
    }
    
    $.ajax({
        type: "POST",
        url: "/characters/remove-share",
        data: {
            "_token": "{{ csrf_token() }}",
            "user_id": userId,
            "character_id": characterId
        },
        success: function(response) {
            loadSharedUsers(characterId); // Ricarica la lista
            alert(response.message);
        },
        error: function(error) {
            alert("Errore nella rimozione della condivisione");
        }
    });
}

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

function shareCharacter() {

    const formData = new FormData(document.getElementById('shareForm'));
    $.ajax({
        type: "POST",
        url: "/characters/share", // Adjust the URL to your route
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