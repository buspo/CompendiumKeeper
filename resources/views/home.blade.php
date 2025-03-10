@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--<div class="card shadow-sm mb-4" style="background-color: #fefcff;">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Welcome '.auth()->user()->username.'. You are logged in!') }}
                    <div class="text-center">
                        <a href="{{ route('users.edit') }}" class="btn btn-info">Manage account</a>
                    </div>

                </div>
            </div>-->
            <div class="card shadow-sm mb-4" style="background-color: #fefcff;">
                <div class="card-header bg-info text-white">{{ __('Characters') }}</div>
                <div class="card-body">
                    <h5 class="card-title">Manage Your Game</h5>
                    <p class="card-text">Access all features to manage your characters and adventures.</p>
                    <div class="text-center">
                        <a href="{{ route('characters.index') }}" class="btn btn-warning">View Characters</a>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mb-4" style="background-color: #fefcff;">
                <div class="card-header bg-success text-white">{{ __('Credits') }}</div>
                <div class="card-body">
                <section class="credits">
                    <p>This character sheet was created using a template shared by various Reddit users. Special thanks to:</p>
                    <ul>
                        <li>u/BackFromOtterSpace</li>
                        <li>u/nevertras</li>
                        <li>u/Con Dar15</li>
                    </ul>
                    <p>If you wish to make and/or distribute your revisions, I only ask that you maintain the attribution, including all users who have previously contributed to this project. Hope you enjoy the character sheet!</p>
                    <p>Source: <a href="https://www.reddit.com/r/DnD/comments/fvxsgj/5e_html_character_sheet_for_5e_with_basic/" target="_blank">post on reddit</a></p>                 
                </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection