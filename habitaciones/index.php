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
    <head>
        <title>Habitaciones | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
    </head>
    <body onload ="getDate('control-date-prev',-1); getDate('control-date-last',0);">  
        <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            setCurrentPage("control-diario");
        </script>

	<div id="content" class="col-12">

		<div class="marco nearly-page">
            <h1>HISTORIAL DE HABITACIONES</h1>
            
            <div class="history-room">
                
                <div class="view-date-history">
                    <label><b>Fecha De Visualización</b></label>
                    <br><br>
                    <div class="row">
                        <div class="form-group in-row">
                            <label class="form-control-label">Fecha inicial</label>
                            <div class="input-group">
                                <div class="input-group-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="doc-date" class="form-control" type="date">
                            </div>
                            <small class="form-text text-muted">ej. 10/11/2019</small>
                        </div>
                        <div class="form-group in-row">
                            <label class="form-control-label">Fecha final</label>
                            <div class="input-group">
                                <div class="input-group-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="doc-date" class="form-control" type="date">
                            </div>
                            <small class="form-text text-muted">ej. 12/11/2004</small>
                        </div>
                    </div>
                </div>
            
                <div class="view-room-history">
                    <label><b>Habitación</b></label>
                    <select class="lista-habitaciones">
                        <option>201</option>
                        <option>202</option>
                        <option>301</option>
                        <option>302</option>
                        <option>303</option>
                        <option>304</option>
                        <option>401</option>
                        <option>402</option>
                        <option>403</option>
                        <option>404</option>
                        <option>501</option>
                        <option>502</option>
                        <option>503</option>
                        <option>504</option>
                        <option>601</option>
                        <option>602</option>
                        <option>603</option>
                    </select>
                </div>
            </div>
            
			<table>
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Huésped(es)</th>
                        <th>Valor consumo ($)</th>
                        <th>Actividad</th>
                        <th></th>
                    </tr>
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