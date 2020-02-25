<!DOCTYPE html>
<html class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title data-status>@lang('Loading')</title>

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
        <p data-status>@lang('Launch container')</p>
    </div>
</div>
<script>
    let eventSource = new EventSource("{{ route('api.instance.status', ['instance' => $instance]) }}");
    eventSource.onmessage = (e) => {
        let data = JSON.parse(e.data);
        let status = data['{{ $instance->status_key }}'];

        console.log(status);
    };
</script>
</body>
</html>
