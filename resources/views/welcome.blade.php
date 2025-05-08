<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="/recursos/css/login.css" />
    <link rel="icon" type="image/png" href="/recursos/img/yape.png">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="logo-container">
                <img src="/recursos/img/yape.png" alt="Logo Yape" class="logo-img" />
            </div>
            <form method="POST" action="{{ route('verificaUsuario') }}">
                @csrf
                <input type="text" id="usuario" name="usuario" placeholder="Usuario" required />
                @error('usuario')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="password" id="password" name="password" placeholder="Contraseña" required />
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
    
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>

</html>