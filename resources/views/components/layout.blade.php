<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Assessment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @session('message')
        <div class="message">{{ session('message') }}</div>
    @endsession
    {{ $slot }}
</body>

</html>