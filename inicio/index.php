<?php
    /**
    * Archivo que contiene el menú principal, visible para la parte administrativa de la aplicación web
    * @package   inicio
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación de la clase denominada classes
    */
    require_once '../includes/classes.php';

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
        <title>Home | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/inicio.css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
    </head>

    
    <body>
        <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "inicio"
            */
            setCurrentPage("inicio");
        </script>

        <div class="content">
            <div class="title">
                <p><strong>HOTEL ARISTO</strong></p>
            </div>
            <div class="menu">
                <a href="/reservas/" class="button">
                    <p>Reservas</p>
                    <img src="/res/img/book-icon-white.png">
                </a>
                <a href="/habitaciones/" class="button">
                    <p>Historial de Habitación</p>
                    <img src="/res/img/room-icon-white.png">
                </a>
                <a href="/control_diario/" class="button">
                    <p>Control diario</p>
                    <img src="/res/img/control-icon-white.png">
                </a>
                <a href="/usuarios/" class="button">
                    <p>Usuarios</p>
                    <img src="/res/img/use-whiter.png">
                </a>
                <a href="/empresas/" class="button">
                    <p>Empresas</p>
                    <img src="/res/img/company-white.png">
                </a>
                <a href="/facturas/" class="button">
                    <p>Facturación</p>
                    <img src="/res/img/bill-icon-white.png">
                </a>
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