<?php 
    /**
    * Archivo que contiene la información acerca de los detalles de una empresa determinada, registrada en la base de datos
    * @package   empresas.detalles
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    require_once '../../includes/classes.php';
    $consult=new Consult();
    $user = new User();
    $userSession = new UserSession();
    
    if(isset($_SESSION['user'])){
        $user->updateDBUser($userSession->getSession());
    }else{
        header('location: /login');
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $e = new Enterprise();
        $e->setIdEnterprise($id);        
    }

    if($e->getId() === NULL){
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html>
    <!--Importación de librerias css y javascript -->
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

    <!--Construcción de la vista-->
    <body onload ="getDate('control-date',0);">
        <?php 
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>

        <script type="text/javascript">
             /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "consultar"
            */
            setCurrentPage("consultar");
        </script>

        <!--Bloque encargado de mostrar la información detallada de una empresa determinada-->
        <div id="content" class="col-12">
            <div class="marco nearly-page">
                <h4>INFORMACIÓN GENERAL</h4>
                <div class="general-info">
                    <div class="region">
                        <label><b>NIT: &ensp;</b></label>
                        <label><?php echo $e->getNit();?></label>
                    </div>
                    <div class="region">
                        <label><b>Nombre: &ensp;</b></label>
                        <label><?php echo $e->getName();?></label>
                    </div>
                    <div class="region">
                        <label><b>Teléfono: &ensp;</b></label>
                        <label><?php echo $e->getPhone();?></label>
                    </div>
                    <div class="region">
                        <label><b>Retefuente (3,5%): &ensp; </b></label>
                        <label><?php echo ($e->getSourceRetention() == 1) ? "Sí" : "No";?></label>
                    </div>
                    <div class="region">
                        <label><b>Otro impuesto ($): &ensp;</b></label>
                        <label> <?php echo $e->getOtherTax();?></label>
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
                            <?php $consult->enterpriseCustomTable($id)?>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php"; 
        ?>
    </body>
</html>