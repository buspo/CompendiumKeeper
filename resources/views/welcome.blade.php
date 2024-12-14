@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">{{ __('Welcome to Character Management') }}</div>
                <div class="card-body">
                    <h5 class="card-title">Manage Your 5e Characters</h5>
                    <p class="card-text">
                        This application allows you to create, edit, and manage your characters for rpg sessions. You can keep track of stats, spells, inventory, and much more.
                    </p>
                    <div class="text-center">
                        <a href="{{ route('characters.create') }}" class="btn btn-warning">Create a New Character</a>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">{{ __('Access') }}</div>
                <div class="card-body text-center">
                    @guest
                        <p>If you are not registered yet, you can do so here:</p>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @else
                        <p>You are already logged in as {{ Auth::user()->name }}.</p>
                        <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">{{ __('Credits') }}</div>
                <div class="card-body">
                    <p>This character sheet was created using a template shared by various Reddit users. Special thanks to:</p>
                    <ul>
                        <li>u/BackFromOtterSpace</li>
                        <li>u/nevertras</li>
                        <li>u/ConDar15</li>
                    </ul>
                    <p>If you wish to create and/or distribute your revisions, I only ask that you maintain the attribution, including all users who have previously contributed to this project. Hope you enjoy the character sheet!</p>
                    <p>Source: <a href="https://www.reddit.com/r/DnD/comments/fvxsgj/5e_html_character_sheet_for_5e_with_basic/"  target="_blank">post on reddit</a></p>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection