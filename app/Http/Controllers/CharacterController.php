<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\User;
use App\Models\UserCharacter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Auth::user()->characters; // Ottieni i personaggi dell'utente autenticato
        $sheet = $characters->merge(Auth::user()->shared);
        //dd(compact('sheet'));
        return view('characters.index', compact('sheet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('characters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sheet' => 'required|json',
            'charname' => 'nullable|string',
        ]);
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        // Crea il personaggio senza salvare il file
        $character = Character::create($input);

        return response()->json(['message' => 'Personaggio creato con successo.', 'id' => $character->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        $jsonContent = $character->sheet;
        if ($character->user_id !== Auth::user()->id) {
            abort(403); // Accesso negato
        }

        // Crea nome file con timestamp
        $filename = 'character sheet '.($character->charname ?? 'personaggio').'.json';

        // Prepara la response per il download
        return response()->streamDownload(function () use ($jsonContent) {
            echo $jsonContent;
        }, $filename, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename='.$filename,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        if ($character->user_id !== Auth::user()->id) {
            abort(403); // Accesso negato
        }

        return view('characters.edit', ['sheet' => $character->sheet, 'id' => $character->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        $request->validate([
            'sheet' => 'required|json',
            'charname' => 'nullable|string',
        ]);
        $input = $request->all();
        if ($character->user_id !== Auth::user()->id) {
            abort(403); // Accesso negato
        }

        // Aggiorna il record del personaggio con il nome del file
        $character->update($input);

        return response()->json(['message' => 'Scheda personaggio salvata con successo.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        if ($character->user_id !== Auth::user()->id) {
            abort(403);
        }

        // Elimina il file dal filesystem
        $character->delete();

        return redirect()->route('characters.index')->with('success', 'Personaggio eliminato con successo.');
    }

    /**
     * Create character from json file.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'sheet_file' => 'required|file|mimes:json|max:2048'
        ]);
        $input = $request->all();
        $input["sheet"] = file_get_contents($input["sheet_file"]->getRealPath());
        $input["user_id"] = Auth::user()->id;
        $input["charname"] = json_decode($input["sheet"])->charname;

        // Aggiorna il record del personaggio con il nome del file
        $character = Character::create($input);

        return response()->json(['message' => 'Scheda personaggio creata con successo.']);
    }

    public function view(Character $character)
    {
        if ($character->user_id !== Auth::user()->id && !$character->users->contains(Auth::user())) {
            abort(403); // Accesso negato
        }
        return view('characters.view', ['sheet' => $character->sheet, 'id' => $character->id]);
    }

    public function share(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|exists:users',
            'character_id' => 'required|exists:characters,id'
        ]);
        $existingUser = User::firstWhere('username', $request->username);
        $character = Character::find($request->character_id);
        
        if ($character->user_id !== Auth::user()->id){
            abort(403); // Accesso negato
        }
        if ($existingUser->id == Auth::user()->id){
            return response()->json(['error' => 'Non puoi condividere schede con te stesso']);
        }

        UserCharacter::create([
            'user_id' => $existingUser->id,
            'character_id' => $character->id
        ]);
        return response()->json(['message' => 'Scheda personaggio condivisa con successo.']);
    }

    public function getSharedUsers(Character $character)
    {
        if ($character->user_id !== Auth::user()->id) {
            abort(403);
        }
    
        $sharedUsers = $character->users()->select('username', 'users.id')->get();
        return response()->json($sharedUsers);
    }

    public function removeShare(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'character_id' => 'required|exists:characters,id'
        ]);
    
        $character = Character::find($request->character_id);
    
        if ($character->user_id !== Auth::user()->id) {
            abort(403);
        }
    
        UserCharacter::where('user_id', $request->user_id)
            ->where('character_id', $request->character_id)
            ->delete();
        
        return response()->json(['message' => 'Condivisione rimossa con successo']);
    }
}
