<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TVN - PAPERLESS - USER MANAGEMENT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
    <script src="/js/app.js" defer></script>
</head>
<body>
<div id="root">
    @yield('content')
</div>
<script>
    @auth
        window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
        window.Roles = {!! json_encode(Auth::user()->role, true) !!};
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(), 'user' => Auth::user()]) !!};
    @else
        window.Permissions = [];
        window.Roles = [];
    @endauth
</script>
{{-- Laravel Mix - JS File --}}
{{-- <script src="{{ mix('js/web.js') }}"></script> --}}
</body>
</html>
