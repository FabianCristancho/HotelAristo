<?php
    /**
    * Archivo que contiene la información pertinente a las empresas almacenadas en la base de datos
    * @package   empresas
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación de las clases requeridas para el buen funcionamiento de la aplicación
    */
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
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
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
            include "../menu/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "consultar"
            */
            setCurrentPage("consultar");
        </script>

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
                                <th>OTRO IMPUESTO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                            /**
                            * Obtiene la tabla con la información de las empresas
                            */
                            $consult->getTable('enterprise');
                        ?>
                    </table>
                </div>
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
