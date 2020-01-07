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
  
    <?php
        include "../objetos/menu.php"; 
    ?>
    <script type="text/javascript">
        setCurrentPage("consultar");
    </script>


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
    <div id="aux-footer" class="col-12"></div>
<?php include "../objetos/pie.php"; ?>
</body>
</html>