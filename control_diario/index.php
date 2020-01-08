<?php
    /**
    * Archivo que contiene la información pertinente al control diario del hotel
    * @package   control_diario
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
        <title>Control diario | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
        <style type="text/css">
            td a:visited{
                color: white;
            }
        </style>
    </head>

    <body onload ="getDate('control-date',0); checkColors();">
        <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "control-diario"
            */
            setCurrentPage("control-diario");
        </script>

        <div id="content" class="col-12">
            <div class="marco nearly-page">
                <h1>CONTROL DE HABITACIONES</h1>
                <div class="input-block-control">
                    <label>Fecha control</label>
                    <br>
                    <button>&lt;</button>
                    <input id="control-date" type="date">
                    <button>&gt;</button>
                </div>
                <div class="scroll-block">
                    <table>
                        <thead>
                            <tr>
                                <th>Habitación</th>
                                <th>Tipo de habitación</th>
                                <th>Nombre huésped(es)</th>
                                <th>Fecha ingreso</th>
                                <th>Conteo diario</th>
                                <th>Total ($)</th>
                                <th>Check up</th>
                                <th>Check out</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                            /**
                            * Obtiene la tabla con la información de las habitaciones
                            */
                            $consult->getTable('room');
                        ?>
                    </table>
                </div>
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
