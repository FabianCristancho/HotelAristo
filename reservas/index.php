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
    <!--Menu de la aplicación web del hotel Aristo la clase main-menu-item pertenece a los botones del menú-->
      <header class="col-12">
          <a href="/inicio">
            <img id="logo-hotel" src="/res/img/logoA.png">
          </a>
          <button  onclick="window.location.href = '/inicio';" class="main-menu-item menu-item" >
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
            <button id="current-item" onclick="window.location.href = '';" class="main-menu-item">
              <img src="/res/img/book-icon-white.png">
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

          <button onclick="window.location.href = '/control_diario';" class="main-menu-item menu-item">
            <img src="/res/img/control-icon-black.png">
            <p>Control diario</p>
          </button>
          <button onclick="window.location.href = '/facturas';" class="main-menu-item menu-item">
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
                <h3 id="requests-title" class="col-9">Reservas de huéspedes</h3>
                <a id="button-add-book" class="col-2" href="">Nueva reserva</a>

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
                </table>
            </div>
        </div>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../footer/footer.php"; 
        ?>
        
    </body>
</html>