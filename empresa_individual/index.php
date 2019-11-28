<!DOCTYPE html>
<html>

    <head>
        <title>Detalles de Empresa | Hotel Aristo</title>
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
                <h4>INFORMACIÓN GENERAL</h4>
                <div class="general-info">
                    <div class="region">
                        <label><b>NIT: &ensp;</b></label>
                        <label>811.028.650-1</label>
                    </div>
                    <div class="region">
                        <label><b>Nombre: &ensp;</b></label>
                        <label>MADECENTRO COLOMBIA SAS</label>
                    </div>
                    <div class="region">
                        <label><b>Teléfono: &ensp;</b></label>
                        <label>7603323</label>
                    </div>
                    <div class="region">
                        <label><b>Retefuente (3,5%): &ensp; </b></label>
                        <label>No</label>
                    </div>
                    <div class="region">
                        <label><b>Otro Retefuente: &ensp;</b></label>
                        <label>No</label>
                    </div>
                </div>
            </div>
            <div class="marco nearly-page">
                <div class="specific-info">
                    <div>
                        <h4><b>HUÉSPEDES AUTORIZADOS POR LA EMPRESA</b></h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Número de Documento</th>
                                    <th>Fecha de check-in</th>
                                    <th>Fecha de check-out</th>
                                    <th>Consumo Total ($)</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Giacomo Guilizzoni</td>
                                <td>1034543</td>
                                <td>03/11/2019</td>
                                <td>07/11/2019</td>
                                <td>124.745</td>
                            </tr>
                            <tr>
                                <td>Pedro Hernandez</td>
                                <td>1054433</td>
                                <td>10/11/2019</td>
                                <td>14/11/2019</td>
                                <td>324.000</td>
                            </tr>
                            <tr>
                                <td>Maria Cely</td>
                                <td>234554342</td>
                                <td>10/11/2019</td>
                                <td>17/11/2019</td>
                                <td>370.843</td>
                            </tr>
                        </table>
                        <br>
                    </div>
                </div>
            </div>

            <div class="button-return">
                <a href="/empresas">Regresar</a>
            </div>
        </div>

        <div id="aux-footer" class="col-12"></div>
        <footer>
            <a href="/home/index.php" class="info">Hotel Aristo</a> &copy; 2019 | Todos los derechos reservados
        </footer>
    </body>
</html>