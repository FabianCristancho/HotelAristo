<?php
    /**
    * Archivo que contiene la información pertinente a las reservas almacenadas en la base de datos
    * @package   reservas
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */
    /**
    * Incluye la implementación de las clases requeridas para el buen funcionamiento de la aplicación
    */
    require_once '../includes/classes.php';
    $consult=new Consult();
    $user = new User();
    $userSession = new UserSession();
    
    if(isset($_SESSION['user'])){
        $user->updateDBUser($userSession->getSession());
    }else{
        header('location: /login');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reservas | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
    </head>
    <body>
    <!--Menu de la aplicación web del hotel Aristo la clase main-menu-item pertenece a los botones del menú-->
      <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>

        <div id="content" class="col-12">
            <div class="marco nearly-page">
                <h2 id="requests-title" class="col-9">RESERVAS DE HUÉSPEDES</h2>
                <a id="button-add-book" class="col-2" href="registrar">Registrar reserva</a>

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
                     <?php
                            $consult->getTable('reservation','');
                      ?>
                </table>
            </div>
        </div>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../objects/footer.php"; 
        ?>
        
    </body>
</html>