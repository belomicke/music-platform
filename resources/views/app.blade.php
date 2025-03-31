<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Music Platform</title>
    <meta name="title" content="Music Platform">
    <meta
        name="viewport"
        content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,shrink-to-fit=no,viewport-fit=cover"
    />

    <link
        rel="icon"
        href="{{ asset("favicon.svg") }}"
        type="image/svg+xml"
    />

    @viteReactRefresh
    @vite(["./resources/js/index.ts"])
</head>
<body>
<div id="portals"></div>
<div id="app"></div>
</body>
</html>
