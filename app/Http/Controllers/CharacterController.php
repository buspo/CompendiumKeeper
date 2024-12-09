<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Models\Character;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Auth::user()->characters; // Ottieni i personaggi dell'utente autenticato
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
    public function store(StoreCharacterRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'level' => 'required|integer',
        ]);

        $character = new Character();
        $character->user_id = Auth::id(); // Associa il personaggio all'utente autenticato
        $character->name = $request->name;
        $character->class = $request->class;
        $character->level = $request->level;
        $character->save();

        return redirect()->route('characters.index')->with('success', 'Character created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharacterRequest $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }
}
