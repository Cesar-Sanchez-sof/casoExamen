<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="/recursos/img/yape.png">
    <link rel="stylesheet" href="/recursos/css/plantilla.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    @yield('css')
</head>

<body class="dashboard-body">
    <!-- Botón hamburguesa (inmediatamente después del <body>) -->
    <button class="hamburger" onclick="toggleSidebar()">☰</button>
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="recursos/img/yape.png" class="logo-img" />
            <h1>YAPE</h1>
        </div>

        <nav>
            <ul>
                <li><a href="{{ route('principal') }}">Principal</a></li>
                <li><a href="{{ route('pagos') }}">Pagos</a></li>
                <li><a href="{{route('deudas')}}">Registra Deudas</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-panel">
        <header class="topbar">
            <img src="/recursos/img/Admin.jpg" class="avatar" />
            <button class="logout"><a href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i></a></button>
        </header>
        <section class="content-box">
            <div class="content-placeholder">
                @yield('contenido')
            </div>
        </section>
    </main>

    <!-- Agrega esto en <head> para icono de menú hamburguesa -->
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('sidebar-open');
        }
    </script>

</body>

</html>
