<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('node_modules/@tailwindplus/elements/dist/index.js')
    <title>Document</title>
</head>
<body class="">
    <x-nav></x-nav>  
    <main>
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 text-center">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
        </div>
    </main>
</body>
</html>