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
    
   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $("#button-update-client").click(function(){
                var documento="";

                $(this).parents("tr").find(".num").each(function(){
                    documento+=$(this).html()+"\n";
                });
                window.location.href = '../edicion_cliente?documento='+documento;
            });
        });
    </script>-->
    
    <body>
        <?php include "../objetos/menu.php"; ?>
        <script type="text/javascript">
            setCurrentPage("consultar");
        </script>

        <div id="content" class="col-12">

            <div class="marco nearly-page">
                <h1 class="heading">CLIENTES</h1>
                <a id="button-more-info" class="btn-new-bill">NUEVO CLIENTE</a>
                
                <div class="scroll-block">
                    
                    <table>
                       
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>TIPO DOCUMENTO</th>
                                <th>NÚMERO DE DOCUMENTO</th>
                                <th>FECHA DE EXPEDICIÓN</th>
                                <th>PROFESIÓN</th>
                                <th>GÉNERO</th>
                                <th>FECHA DE NACIMIENTO</th>
                                <th>TIPO DE SANGRE</th>
                                <th>TELÉFONO</th>
                                <th>CORREO</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                       <?php
                        
                            $consult->getTable('customers');
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div id="aux-footer" class="col-12"></div>
        <?php include "../objetos/pie.php"; ?>
    </body>
</html>
