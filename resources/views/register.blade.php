<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="/recursos/css/login.css" />
    <link rel="icon" type="image/png" href="/recursos/img/yape.png">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="logo-container">
                <img src="/recursos/img/yape.png" alt="Logo Yape" class="logo-img" />
            </div>
            <form method="POST" action="{{ route('registeUser') }}" id="registroForm">
                @csrf
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required />
                @error('nombre')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required />
                @error('apellidos')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="text" id="userName" name="userName" placeholder="Nombre de usuario" required />
                @error('userName')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required />
                @error('correo')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" required />
                @error('telefono')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required />
                @error('contrasena')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="password" id="confirmacion_contrasena" name="confirmacion_contrasena"
                    placeholder="Confirmar contraseña" required />
                @error('confirmacion_contrasena')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit">Registrarse</button>
            </form>
            <a href="{{ route('login') }}" class="forgot-link">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>

    
</body>

</html>
