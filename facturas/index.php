<!DOCTYPE html>
<html>

<head>
	<title>Facturas | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/img/famicon.png" />
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/main-800.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1024.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="../css/alerts.css">
	<script type="text/javascript" src="../js/moment.js"></script>
	<script type="text/javascript" src="../js/dynamic.js"></script>
</head>

<body>
                <header class="col-12">
            <a href="../inicio">
                <img id="logo-hotel" src="../res/img/logoA.png">
            </a>
            <button onclick="window.location.href = '../inicio';" class="main-menu-item menu-item" >
                <img src="../res/img/home-icon-black.png">
                <p>Inicio</p>
            </button>

            <div class="dropdown menu-item">
                    <button onclick="window.location.href = '';"   class="main-menu-item">
                        <img src="../res/img/book-icon-black.png">
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
                        <img src="../res/img/book-icon-black.png">
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
                <button id="current-item" onclick="window.location.href = '';" class="main-menu-item menu-item">
                    <img src="../res/img/bill-icon-white.png">
                    <p>Facturación</p>
                </button>

                <button onclick="window.location.href = '../includes/logout.php';" class="main-menu-item menu-item">
                    <img src="../res/img/logout-icon-black.png">
                    <p>Cerrar sesión</p>
                </button>
        </header>

	<div id="content" class="col-12">

		<div class="marco nearly-page">
            <h1 class="heading">FACTURAS (Registro es un ejemplo para enlazar reportes)</h1>
            <div class="scroll-block">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>FECHA DE FACTURACIÓN</th>
                            <th>HUÉSPED</th>
                            <th>VALOR FACTURADO($)</th>
                            <th>RESPONSABLE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>C123</td>
                        <td>12/11/2019</td>
                        <td>Martha Sánchez</td>
                        <td>120.000</td>
                        <td>zULY lÓPEZ</td>
                        <td> <a href="../factura/index.php" id="button-more-info" class="col-10">Más información</a> </td>
                </tr>
                    
                </table>
            </div>
		</div>
	</div>
	<div id="aux-footer" class="col-12"></div>
	<footer class="col-12">
		Hotel Aristo 2019
	</footer>

</body>
</html>
