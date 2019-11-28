<!DOCTYPE html>
<html>

<!--Importación de librerias css y javascript -->
<head>
  <title>Reservas | Hotel Aristo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/res/img/famicon.png" />
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/main-800.css">
  <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
  <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
  <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
  <link rel="stylesheet" type="text/css" href="/css/alerts.css">
  <link rel="stylesheet" type="text/css" href="/css/modal.css">
  <script type="text/javascript" src="/js/moment.js"></script>
  <script type="text/javascript" src="/js/dynamic.js"></script>
</head>
<body>
    
<!--Menu de la aplicación web del hotel Aristo
  la clase main-menu-item pertenece a los botones del menú-->
    <header class="col-12">
        <a href="/home/index.php">
            <img id="logo-hotel" src="/res/img/logoA.png">
        </a>
        <button onclick="window.location.href = '/home/index.php';" class="main-menu-item menu-item" >
            <img src="/res/img/home-icon-black.png">
            <p>Inicio</p>
        </button>

        <div class="dropdown menu-item">
            <button onclick="window.location.href = 'index.php';" id="current-item" class="main-menu-item">
            <img src="/res/img/book-icon-white.png">
            <p>Reservas</p>
            </button>
            <br>
            <div class="dropdown-content">
              <a href="/reserva/index.php">Nueva reserva</a>
            </div>
        </div>
        <button onclick="window.location.href = '/historial_habitacion/index.php';" class="main-menu-item menu-item">
          <img src="/res/img/room-icon-black.png">
          <p>Historial de <br/> Habitación</p>
        </button>

        <button onclick="window.location.href = '/control/index.php';" class="main-menu-item menu-item">
          <img src="/res/img/control-icon-black.png">
          <p>Control diario</p>
        </button>
        <button onclick="window.location.href = '';" class="main-menu-item menu-item">
          <img src="/res/img/bill-icon-black.png">
          <p>Facturación</p>
        </button>
        <div class="ln">
	       <img id="line" src="/res/img/lineas2.png">
        </div>
    </header>

    <div id="content" class="col-12">
        <div class="marco nearly-page">
            <h3 id="requests-title" class="col-9">Reservas de huéspedes</h3>
            <a id="button-add-book" class="col-2" href="reserva.html">Nueva reserva</a>
            
            <table>
                <tr>
                  <th>N°</th>
                  <th>Check in</th>
                  <th>Check on</th>
                  <th>Nombre completo</th>
                  <th>Telefono</th>
                  <th>Fecha de llegada</th>
                  <th>Fecha de salida</th>
                  <th>Cantidad de noches</th>
                  <th>Empresa</th>
                  <th>Correo</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td><input title="Modificar check in" class="checked-in button-check-in" type="button" value="Hecho"></td>
                  <td><input type="checkbox" name=""></td>
                  <td><a title="Ver informacion detallada" href="">Juan Fernando Lopez Gomez</a></td>
                  <td>3123123454</td>
                  <td>05/10/2019</td>
                  <td>07/10/2019</td>
                  <td>2</td>
                  <td>Argos</td>
                  <td>juan.fernado.lopez.gomez@gmail.com</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td><input title="Hacer check in" class="without-check-in button-check-in" type="button" value="Registrar"></td>
                  <td><input type="checkbox" name=""></td>
                  <td><a title="Ver informacion detallada" href="">Luis Daniel Fernandez Diaz</a></td>
                  <td>3134541278</td>
                  <td>05/10/2019</td>
                  <td>09/10/2019</td>
                  <td>4</td>
                  <td></td>
                  <td>luis.f.d@gmail.com</td>
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