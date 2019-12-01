<!DOCTYPE html>
<html>

<head>
	<title>Historial de Habitación | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/res/img/famicon.png" />
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/main-800.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
    <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="/css/alerts.css">
	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/dynamic.js"></script>
</head>

<body onload ="getDate('control-date',0);">
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

		<div class="marco nearly-page">
            <h1>HISTORIAL DE HABITACIONES</h1>
            
            <div class="history-room">
                <div class="view-date-history">
                    <label><b>Fecha De Visualización</b></label>
                    <br><br>
                    <label>Fecha Inicial &emsp; &emsp; &emsp; &ensp; Fecha Final</label>

                    <br>
                    <input id="control-date" type="date">
                    <input id="control-date" type="date">
                </div>
            
                <div class="view-room-history">
                    <label><b>Habitación</b></label>
                    <select class="lista-habitaciones">
                        <option>201</option>
                        <option>202</option>
                        <option>301</option>
                        <option>302</option>
                        <option>303</option>
                        <option>304</option>
                        <option>401</option>
                        <option>402</option>
                        <option>403</option>
                        <option>404</option>
                        <option>501</option>
                        <option>502</option>
                        <option>503</option>
                        <option>504</option>
                        <option>601</option>
                        <option>602</option>
                        <option>603</option>
                    </select>
                </div>
            </div>
            
			<table>
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Huésped(es)</th>
                        <th>Valor consumo ($)</th>
                        <th>Actividad</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tr>
                    <td class="room-cell">22</td>
                    <td>14:00</td>
                    <td>Giacomo,Gugleimo,Martha</td>
                    <td></td>
                    <td>Check in</td>
                    <td> <a href="/historial_habitacion_individual/index.php" id="button-more-info" class="col-10">Más información</a> </td>
                </tr>
                <tr>
                    <td class="room-cell">22</td>
                    <td>18:00</td>
                    <td>Pedro Perez</td>
                    <td>90.000</td>
                    <td>Check out</td>
                    <td> <a href="historial_habitacion_individual.html" id="button-more-info" class="col-10">Más información</a> </td>
                </tr>
                <tr>
                    <td class="room-cell">25</td>
                    <td>18:00</td>
                    <td>Giacomo,Gugleimo,Martha</td>
                    <td>120.000</td>
                    <td>Check out</td>
                    <td> <a href="historial_habitacion_individual.html" id="button-more-info" class="col-10">Más información</a> </td>
                </tr>
                <tr>
                    <td class="room-cell">22</td>
                    <td>14:00</td>
                    <td>Martha Granados</td>
                    <td></td>
                    <td>Check in</td>
                    <td> <a href="historial_habitacion_individual.html" id="button-more-info" class="col-10">Más información</a> </td>
                </tr>
            </table>
		</div>
	</div>
	<div id="aux-footer" class="col-12"></div>
	<footer>
        <a href="/home/index.php" class="info">Hotel Aristo</a> &copy; 2019 | Todos los derechos reservados
    </footer>
</body>
</html>