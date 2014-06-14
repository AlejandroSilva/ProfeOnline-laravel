<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>login form</title>
</head>
<body>
    <div>
        <h1>Acceso a Profe Online</h1>
        {{ Form::open([
            'action'=>'SessionController@validar'
        ]) }}
        <div>
            {{ Form::label("email", "Correo electronico") }}
            {{ Form::input("email", "email") }}
        </div>
        <div>
            {{ Form::label("password", "Contraseña") }}
            {{ Form::input("password", "password") }}
        </div>
        <div>
            {{ Form::submit('Entrar') }}
        </div>

        {{ Form::close() }}
    </div>
</body>
</html>