<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'Todo with Livewire')</title>
        
        <!-- Favicon -->
        <meta property="og:image" content="{{ asset('favicon.png') }}" />
        <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">

        @vite('resources/css/app.css')

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Sans+HK:wght@100;300;400;500;700;900&display=swap"
            rel="stylesheet"
        />

    </head>
    <body>
        {{ $slot }}


        <x-toaster-hub />
        @vite('resources/js/app.js')
    </body>
</html>
