<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Facturation Pro API Form</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/tailwind.css" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="antialiased">
        <div class="grid">
            <div class="justify-self-center w-500">
                <h1>facturation.pro - API tester</h1>
                <hr>
                @livewire('facturation-pro-form')
            </div>
        </div>
    </body>

    @livewireScripts
</html>
