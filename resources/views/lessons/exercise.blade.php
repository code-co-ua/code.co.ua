<!DOCTYPE html>
<html class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title data-status>Завантаження</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
</head>
<body class="h-100 bg-dark">
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center flex-column text-light">
        <div class="spinner-border m-4" role="status"></div>
        <p data-status>Запуск контейнера</p>
    </div>
</div>
<script>
setTimeout(function () {
    // axios.
    //spatie dom
}, 3000);
</script>
</body>
</html>
