<?php
   include_once '../includes/database.php';
   include_once '../includes/consult.php';
    $consult=new Consult();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Clientes | Hotel Aristo</title>
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
        <?php 
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>

        <script type="text/javascript">
            setCurrentPage("consultar");
        </script>

        <div id="content" class="col-12">

            <div class="marco nearly-page">
                <h1 class="heading">CLIENTES</h1>
                <a href="registrar" id="button-more-info" class="btn-new-bill">NUEVO CLIENTE</a>
                
                <div class="scroll-block">
                    
                    <table>
                       
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>NÚMERO DE DOCUMENTO</th>
                                <th>TELÉFONO</th>
                                <th>CORREO</th>
                                <th>PROFESIÓN</th>
                                <th>DETALLES</th>
                            </tr>
                        </thead>
                        
                       <?php
                        
                            $consult->getTable('customers');
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
