<?php

namespace App\Http\Controllers;

use App\Models\Character;
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

        //dd(compact('characters'));
        return view('characters.index', compact('characters'));
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
}
