<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Celke</title>
        
    </head>
    <body>

        <h1>Projeto Laravel</h1>

        <a href="{{ route('vacation.index') }}">Listar as Contas</a>
        
    </body>
</html>
