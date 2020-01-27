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
    <!--Importación de librerias css y javascript -->
    <head>
        <title>Reservas | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <link rel="stylesheet" type="text/css" href="/css/table.css">
        <link rel="stylesheet" type="text/css" href="/css/modal.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
        <script type="text/javascript" src="/js/jquery.js"></script>
    </head>
    
    <!--Construcción de la vista-->
    <body>
      <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>

        <!--Bloque que contiene una tabla con la información básica de las reservas-->
        <div class="content col-12">
            <div class="col-11 wrap-11 marco wrap-vertical padd">
               <div class="content-header">
                    <h2 class="title-form col-10">RESERVAS DE HUÉSPEDES</h2>
                    <a class="button-add-book col-2" href="registrar">Registrar reserva</a>
                </div>

                <div class="scroll-block">
                    <table>
                        <tr>
                          <th>N°</th>
                          <th>Check in</th>
                          <th>Check on</th>
                          <th>Nombre completo</th>
                          <th>Telefono</th>
                          <th>Fecha de llegada</th>
                          <th>Cantidad de noches</th>
                          <th>Empresa</th>
                          <th>Correo</th>
                        </tr>
                         <?php
                            /**
                            * Invoca al método getTable('reservation', '') que se encarga de obtener de la base de datos los datos de las *reservaciones efectuadas
                            */
                            $consult->getTable('reservation','');
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

        <div id="confirm-check-on" class="modal" onclick="touchOutside(this);";>
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div>
                        <button class="btn btn-block btn-register" onclick="updateProfession();">
                            <i class="fa fa-check"></i>
                            <span>Confirmar check on</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function setCheckOn(reservation, input){
                if(input.checked)
                    showModal('confirm-check-on');
            }
        </script>
    </body>
</html>