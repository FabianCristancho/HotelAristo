<?php
    include_once '../includes/database.php';
    include_once '../includes/consult.php';
    $consult=new Consult();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Empresas registradas | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="res/img/famicon.png" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/main-800.css">
	<link rel="stylesheet" type="text/css" href="css/main-1024.css">
	<link rel="stylesheet" type="text/css" href="css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="css/alerts.css">
	<script type="text/javascript" src="js/moment.js"></script>
	<script type="text/javascript" src="js/dynamic.js"></script>
</head>

<body onload ="getDate('control-date',0);">
    <header class="col-12">
        <a href="/home/index.php">
            <img id="logo-hotel" src="res/img/logoA.png">
        </a>
        <button onclick="window.location.href = '/home/index.php';" class="main-menu-item menu-item" >
            <img src="res/img/home-icon-black.png">
            <p>Inicio</p>
        </button>

        <div class="dropdown menu-item">
            <button onclick="window.location.href = '/home/index.php';"  class="main-menu-item">
                <img src="res/img/book-icon-black.png">
                <p>Reservas</p>
            </button>
            <br>
            <div class="dropdown-content">
                <a href="/reserva/index.php">Nueva reserva</a>
            </div>
        </div>
        <button onclick="window.location.href = '/historial_habitacion/index.php';" class="main-menu-item menu-item">
            <img src="res/img/room-icon-black.png">
            <p>Historial de <br/> Habitación</p>
        </button>

        <button onclick="window.location.href = '/control/index.php';" class="main-menu-item menu-item">
            <img src="res/img/control-icon-black.png">
            <p>Control diario</p>
        </button>
        <button onclick="window.location.href = '';" class="main-menu-item menu-item">
            <img src="res/img/bill-icon-black.png">
            <p>Facturación</p>
        </button>
    </header>

	<div id="content" class="col-12">

		<div class="marco nearly-page">
            <h1>EMPRESAS REGISTRADAS</h1>
            <div class="scroll-block">
                <table>
                    <thead>
                        <tr>
                            <th>NIT</th>
                            <th>NOMBRE</th>
                            <th>TELEFONO</th>
                            <th>RETEFUENTE (3,5 %)</th>
                            <th>OTRO RETEFUENTE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                        $consult->getTable('enterprise');
                    ?>
                    
                </table>
            </div>
		</div>
	</div>
	<div id="aux-footer" class="col-12"></div>
	<footer>
        <a href="/home/index.php" class="info">Hotel Aristo</a> &copy; 2019 | Todos los derechos reservados
    </footer>

</body>
</html>
