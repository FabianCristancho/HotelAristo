<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/img/famicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/inicio.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/main-800.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1024.css">
    <link rel="stylesheet" type="text/css" href="../css/main-1220.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="../css/alerts.css">
	<script type="text/javascript" src="../js/moment.js"></script>
	<script type="text/javascript" src="../js/dynamic.js"></script>
</head>
<body>
	<header class="col-12">
		<a href="/inicio">
			<img id="logo-hotel" src="/res/img/logoA.png">
		</a>
		<button id="current-item"  onclick="window.location.href = '/inicio';" class="main-menu-item menu-item" >
			<img src="../res/img/home-icon-white.png">
			<p>Inicio</p>
		</button>

		<div class="dropdown menu-item">
			<button onclick="window.location.href = '';"   class="main-menu-item">
				<img src="/res/img/book-icon-black.png">
				<p>Registrar</p>
			</button>
			<br>
			<div class="dropdown-content">
				<a href="../nueva_reserva">Registar reserva</a>
				<a href="../nueva_empresa">Registrar empresas</a>
			</div>
		</div>

		<div class="dropdown menu-item">
			<button onclick="window.location.href = '';" class="main-menu-item">
				<img src="/res/img/book-icon-black.png">
				<p>Consultar</p>
			</button>
			<br>
			<div class="dropdown-content">
				<a href="../reservas">Consultar reservas</a>
				<a href="../clientes">Consultar clientes</a>
				<a href="../empresas">Consultar empresas</a>
				<a href="../habitaciones">Consultar habitaciones</a>
			</div>
		</div>

		<button onclick="window.location.href = '../control_diario';" class="main-menu-item menu-item">
			<img src="../res/img/control-icon-black.png">
			<p>Control diario</p>
		</button>
		<button onclick="window.location.href = '../facturas';" class="main-menu-item menu-item">
			<img src="/res/img/bill-icon-black.png">
			<p>Facturación</p>
		</button>
		<button onclick="window.location.href = '../includes/logout.php';" class="main-menu-item menu-item">
			<img src="../res/img/logout-icon-black.png">
			<p>Cerrar sesión</p>
		</button>
    </header>

</body>
</html>