<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Vuebnb</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/open-sans.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/vue-style.css') }}">
        <script type='text/javascript'> 
            window.vuebnb_server_data = "{!! addslashes(json_encode($data)) !!}"; 
            window.csrf_token = "{{ csrf_token() }}";
        </script>
    </head>
    <body>
        <div id="app"></div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>