<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" style="scroll-behavior: smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="min-h-screen bg-blue-50 text-[#1f295a] font-roboto antialiased dark:bg-[#0D0C22] dark:text-slate-200" style="margin-bottom: 0 !important;">
    @inertia

    <script></script>
</body>

</html>
