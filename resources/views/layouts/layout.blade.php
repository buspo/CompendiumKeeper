<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Character Sheet')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        @yield('content') <!-- Qui verrà inserito il contenuto delle altre view -->
    </div>
    <footer class="footer" style="position: fixed; bottom: 0; left: 0; right: 0; background-color: rgba(255, 255, 255, 0.8); color: gray; text-align: center; padding: 10px;">
    This card was created using a template shared by various users on Reddit. Special thanks to u/BackFromOtterSpace, u/nevertras, and u/ConDar15.<br>
    Source: <a href="https://www.reddit.com/r/DnD/comments/fvxsgj/5e_html_character_sheet_for_5e_with_basic/">post on reddit</a>
    </footer>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    @yield('script')
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>