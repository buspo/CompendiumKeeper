@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4" style="background-color: #003366; padding: 20px; border-radius: 8px;">
                <img src="{{ asset('CompendiumKeeper.png') }}" alt="Logo" class="img-fluid" style="max-width: 50%; height: auto;">
            </div>
            <div class="card shadow-sm mb-4" style="background-color: #fefcff;">
                <div class="card-header bg-info text-white">{{ __('Access') }}</div>
                <div class="card-body text-center">
                    @guest
                        <p>If you are not registered yet, you can do so here:</p>
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
                        </div>
                    @else
                        <p>You are already logged in as {{ Auth::user()->name }}.</p>
                        <a href="{{ route('home') }}" class="btn btn-info">Home</a>
                    @endguest
                </div>
            </div>
            <div class="card shadow-sm mb-4" style="background-color: #fefcff;">
                <div class="card-header bg-success text-white">{{ __('Credits') }}</div>
                <div class="card-body">
                    <p>This character sheet was created using a template shared by various Reddit users. Special thanks to:</p>
                    <ul>
                        <li>u/BackFromOtterSpace</li>
                        <li>u/nevertras</li>
                        <li>u/ConDar15</li>
                    </ul>
                    <p>If you wish to create and/or distribute your revisions, I only ask that you maintain the attribution, including all users who have previously contributed to this project. Hope you enjoy the character sheet!</p>
                    <p>Source: <a href="https://www.reddit.com/r/DnD/comments/fvxsgj/5e_html_character_sheet_for_5e_with_basic/" target="_blank">post on reddit</a></p>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection