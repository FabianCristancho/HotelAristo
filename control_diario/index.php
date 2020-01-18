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
    $date="";
    if(isset($_GET['date'])){
        $date = $_GET['date'];      
    }
?>


<!DOCTYPE html>
<html>
    <!--Importación de librerias css y javascript -->
    <head>
        <title>Control diario | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <link rel="stylesheet" type="text/css" href="/css/table.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
    </head>
    
    <!--Construcción de la vista-->
    <body onload ="checkColors();" >
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
        
        <!--Bloque que contiene una tabla  con el control de habitaciones de acuerdo a una fecha seleccionada por el usuario-->
        <div class="content col-12">
            <div class="col-11 wrap-11 marco wrap-vertical padd">
                <div class="content-header padd">
                    <h2 class="title-form col-12">CONTROL DE HABITACIONES</h2>
                </div>
                    <div class="form-group col-3">
                        <label class="form-control-label">Fecha de control</label>
                        <div class="input-group">
                            <button onclick="window.location.href='/control_diario/?date='+calculateDate(document.getElementById('control-date').value,-1)">&lt;</button>
                            <div class="input-group-icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="control-date" class="form-control" type="date" value="<?php echo $date; ?>">
                            <button onclick="window.location.href='/control_diario/?date='+calculateDate(document.getElementById('control-date').value,1)">&gt;</button>
                        </div>
                        <small class="form-text text-muted">ej. 10/11/2019</small>
                    </div>

                <div class="scroll-block">
                    <table>
                        <thead>
                            <tr>
                                <th>T</th>
                                <th>Habitación</th>
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
                        * Invoca al método getTable('room', $date) que se encarga de obtener de la base de datos el control que se ha llevado a cabo * de las habitaciones en la fecha prevista
                        */
                            $consult->getTable('room', $date);
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
