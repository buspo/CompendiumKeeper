@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
    <!--<h1 class="my-4" style="color: #0056b3;">Welcome to the Character Sheet</h1 > -->

    <div class="card mb-4" style="background-color: #fefcff;">
        <div class="card-body">
            <h5 class="card-title  title-blue">Your Characters</h5 >
            <p class="card-text">Here you can manage your characters.</p>
            <div class="text-center">
            <a href="{{ route('characters.index') }}" class="btn btn-blue">View Characters</a>
            </div >
        </div>
    </div>

    <div class="card mb-4" style="background-color: #fefcff;">
        <div class="card-body">
            <h5 class="card-title  title-blue">Create a New Character</h5 >
            <p class="card-text">Start your adventure by creating a new character.</p>
            <div class="text-center">
            <a href="{{ route('characters.create') }}" class="btn btn-blue">Create Character</a >
            </div>
        </div>
    </div>

    <div class="card mb-4" style="background-color: #fefcff;">
        <div class="card-body">
            <h5 class="card-title  title-blue">Credits</h5 >
            <p>This character sheet was created using a template shared by various Reddit users. Special thanks to:</p>
            <ul>
                <li>u/BackFromOtterSpace</li>
                <li>u/nevertras</li>
                <li>u/ConDar15</li>
            </ul>
            <p>If you wish to create and/or distribute your revisions, I only ask that you maintain the attribution, including all users who have previously contributed to this project. Hope you enjoy the character sheet!</p>
            <p>Source: <a href="https://www.reddit.com/r/DnD/comments/fvxsgj/5e_html_character_sheet_for_5e_with_basic/" target="_blank" style="color: #0056b3;">post on reddit</a></p>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection