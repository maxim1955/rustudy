<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel + Vue 3</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('RKI_games/TemplateData/favicon.ico') }}">
    <!-- Scripts -->
    @vite([ 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('RKI_games/TemplateData/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tests.css') }}">
    <link rel="stylesheet" href="{{ asset('css/testpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modalCreateMaterial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/book.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal-order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal-news.css') }}">
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal-feedback.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-tel-input/dist/vue-tel-input.css" />
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal-offer.css') }}">
</head>
<body>
<div id="app"></div>
<script src="https://api-maps.yandex.ru/2.1/?apikey=ваш API-ключ&lang=ru_RU" type="text/javascript">
</script>
</body>
</html>
