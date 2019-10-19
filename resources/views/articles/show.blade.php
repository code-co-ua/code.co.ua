<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $article->name }}</title>
    {{--<meta name="description" content="{{ $article->description }}">--}}
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $article->name }}">
    <meta property="og:image" content="{{ $article->image }}">
    <meta property="og:site_name" content="code.co.ua">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="author" content="{{ $article->user->name }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Custom fonts for this template -->
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('css/clean-blog.css') }}">
</head>

<body>
<div id="app">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            @include('components.nav')
        </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ $article->image }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>{{ $article->name }}</h1>
                        <span class="subheading">{{ $article->description }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row mb-1">
            <div class="col-md-10 mx-auto">
                @parsedown($article->body)
            </div>
            @include('users._item', ['user' => $article->user])
            <div class="col-lg-12">
                <hr>
                <h3>Коментарі:</h3>

                @comments(['model' => $article])
                @endcomments
            </div>
        </div>
    </div>
</div>
<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://t.me/codecoua">
                            <img src="{{ asset('img/telegram.svg') }}" alt="telegram logo">
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Всі права захищено &copy; code.co.ua 2018</p>
            </div>
        </div>
    </div>
</footer>

</body>

</html>
