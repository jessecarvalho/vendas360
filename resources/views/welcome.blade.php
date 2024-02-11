<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter selection:text-white bg-gradient-to-r from-blue-900 to-blue-700">

            <div>
                <h2 class="text-5xl uppercase font-black text-white">Vendas360</h2>
                <h3 class="text-xl text-center text-white">Seja bem vindo</h3>

                @if (Route::has('login'))
                    <div class="flex justify-between w-1/2 m-auto mt-10 w-full">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="border border-blue-500 text-white py-3 rounded w-full text-center font-semibold dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm hover:bg-white hover:text-black">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="border border-blue-500 text-white py-3 rounded w-1/2 text-center font-semibold dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm hover:bg-white hover:text-black">Entrar</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="w-1/2 text-center py-3 text-white rounded border border-blue-500 ml-4 font-semibold dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm hover:bg-white hover:text-black">Registrar</a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>
        </div>
    </body>
</html>
