<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Service-Bank</title>
    <style>
        .body-service {
            background: linear-gradient(to right, darkblue, darkviolet);
            width: 100%;
            margin: auto;
        }
    </style>
</head>
<body class="body-service">
<div id="service">@csrf</div>
<script src="{{ asset('js/app.jsx') }}"></script>
<script>
    const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMetaTag) {
        console.error('CSRF meta tag not found');
    }
</script>
</body>
</html>
