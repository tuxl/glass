<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>管理后台</title>
        <link href="{{ mix('/static/css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app"></div>
    </body>
    <script src="{{ mix('/static/js/app.js') }}"></script>
</html>
