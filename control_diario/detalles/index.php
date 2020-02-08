<?php
    /**
    * Archivo que contiene la información pertinente a los detalles de control de una habitación en una fecha especificada
    * @package   control_diario.detalles
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

    $id="";
    if(isset($_GET['id']))
        $id=$_GET['id'];
?>


<!DOCTYPE html>
<html>
    <!--Importación de librerias css y javascript -->
	<head>
		<title>Control por habitación | Hotel Aristo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/res/img/famicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" type="text/css" href="/css/modal.css">
        <link rel="stylesheet" type="text/css" href="/css/table.css">
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
            include "../../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "control-diario"
            */
            setCurrentPage("control-diario");
        </script>
        
        <!--El bloque contiene la información correspondiente a los detalles de control de una habitación en una fecha especificada-->
        <div class="content col-12 padd">
            <div class="wrap-main wrap-main-big col-10 wrap-10 padd">
                <div class="content-header">
                    <h2 class="title-form">DETALLES DE LA RESERVA</h2>
                </div>

                <div class="sub-menu col-12">
                    <button id="back-btn">Volver</button>
                    <button id="edit-btn">Editar</button>
                    <button id="delete-btn">Eliminar</button>
                </div>

                <div class="card-row">
                    <div class="col-3 padd">
                        <div class="card">
                            <div class="card-header">
                                <strong>Información primaria</strong>
                            </div>

                            <div class="card-body">
                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-9 padd">
                        <div class="card">
                            <div class="card-header">
                                <strong>Titular</strong>
                            </div>

                            <div class="card-body">
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/alerts.php"; 
            include "../../objects/footer.php"; 
        ?>
    </body>
</html>