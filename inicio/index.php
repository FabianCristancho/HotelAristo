<?php 
    include_once '../includes/user.php';
    $user = new User();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Inicio| Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/res/img/famicon.png" />
    <link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/home.css">
	<link rel="stylesheet" type="text/css" href="/css/main-800.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="/css/alerts.css">
	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/dynamic.js"></script>
</head>

<body onload ="checkColors();">
                <header class="col-12">
            <a href="/inicio">
                <img id="logo-hotel" src="/res/img/logoA.png">
            </a>
            <button onclick="window.location.href = '/inicio';" class="main-menu-item menu-item" >
                <img src="/res/img/home-icon-black.png">
                <p>Inicio</p>
            </button>

            <div class="dropdown menu-item">
                    <button onclick="window.location.href = '';"   class="main-menu-item">
                        <img src="/res/img/book-icon-black.png">
                        <p>Registrar</p>
                    </button>
                    <br>
                    <div class="dropdown-content">
                        <a href="/nueva_reserva">Registar reserva</a>
                        <a href="/nueva_empresa">Registrar empresas</a>
                    </div>
                </div>

                <div class="dropdown menu-item">
                    <button onclick="window.location.href = '';" class="main-menu-item">
                        <img src="/res/img/book-icon-black.png">
                        <p>Consultar</p>
                    </button>
                    <br>
                    <div class="dropdown-content">
                        <a href="/reservas">Consultar reservas</a>
                        <a href="/clientes">Consultar clientes</a>
                        <a href="/empresas">Consultar empresas</a>
                        <a href="/habitaciones">Consultar habitaciones</a>
                    </div>
                </div>


                <button id="current-item" onclick="window.location.href = '/control_diario';" class="main-menu-item menu-item">
                    <img src="/res/img/control-icon-white.png">
                    <p>Control diario</p>
                </button>
                <button onclick="window.location.href = '';" class="main-menu-item menu-item">
                    <img src="/res/img/bill-icon-black.png">
                    <p>Facturación</p>
                </button>

                <button onclick="window.location.href = '/includes/logout.php';" class="main-menu-item menu-item">
                    <img src="/res/img/logout-icon-black.png">
                    <p>Cerrar sesión</p>
                </button>
        </header>

	<div id="content" class="col-12">
<div class="menu">
        <a href="#" class="button-i">
            <p>Reserva</p>
            <img src="/res/img/book-icon-white.png">
        </a>
        <a href="#" class="button-i">
            <p>Historial de </br>Habitación</p>
            <img src="/res/img/room-icon-white.png">
        </a>
        <a href="#" class="button-i">
            <p>Control Diario</p>
            <img src="/res/img/control-icon-white.png">
        </a>
        <a href="#" class="button-i">
            <p>Usuarios</p>
            <img src="/res/img/use-whiter.png">
        </a>
        <a href="#" class="button-i">
            <p>Empresas</p>
            <img src="/res/img/company-white.png">
        </a>
        <a href="#" class="button-i">
            <p>Facturación</p>
            <img src="/res/img/bill-icon-white.png">
        </a>
        
    </div>
	</div>
	<div id="aux-footer" class="col-12"></div>
	<footer class="col-12">
		Hotel Aristo 2019
	</footer>

</body>
</html>
