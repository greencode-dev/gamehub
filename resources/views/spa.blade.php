<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'GameHub') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @php
            $hotFile = public_path('hot');
            $viteUrl = $hotFile && file_exists($hotFile) ? trim(file_get_contents($hotFile)) : null;
        @endphp

        @if($viteUrl)
        <script type="module">
            import RefreshRuntime from '{{ $viteUrl }}/@react-refresh';
            RefreshRuntime.injectIntoGlobalHook(window);
            window.$RefreshReg$ = () => {};
            window.$RefreshSig$ = () => (type) => type;
            window.__vite_plugin_react_preamble_installed__ = true;
        </script>
        @endif

        @vite(['resources/css/app.css', 'resources/js/main.jsx'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div id="root"></div>
    </body>
</html>
