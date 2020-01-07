<!DOCTYPE html>
<html>

<head>
	<title>Historial de Habitación | Hotel Aristo</title>
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

<body onload ="getDate('control-date',0);">
        <?php include "../../menu/menu.php"; ?>
        <script type="text/javascript">
            setCurrentPage("control-diario");
        </script>
    
    <div id="content" class="col-12">
        <div class="marco nearly-page">
            <h4>INFORMACIÓN GENERAL</h4>
            <div class="general-info">
                <div class="region">
                    <label><b>Fecha: &ensp;</b></label>
                    <label>22/11/2019</label>
                </div>
                <div class="region">
                    <label><b>Hora: &ensp;</b></label>
                    <label>14:00</label>
                </div>
                <div class="region">
                    <label><b>Habitación: &ensp;</b></label>
                    <label>201</label>
                </div>
                <div class="region">
                    <label><b>Actividad: &ensp; </b></label>
                    <label>Check in</label>
                </div>
                <div class="region">
                    <label><b>Valor total de consumo ($): &ensp;</b></label>
                    <label>75.000</label>
                </div>
                
            </div>
            </br>
            <div class="specific-info">
                <div>
                    <h4><b>HUÉSPEDES</b></h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Número de Documento</th>
                                <th>Tipo de sangre</th>
                                <th>Empresa</th>
                                <th>Nacionalidad</th>
                                <th>Profesión</th>
                                <th>Teléfono</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>Giacomo Guilizzoni</td>
                            <td>1034543</td>
                            <td>B+</td>
                            <td>Falabella</td>
                            <td>Italia</td>
                            <td>Médico</td>
                            <td>3125435432</td>
                        </tr>
                        <tr>
                            <td>Gugleimo Guilizzoni</td>
                            <td>1035443</td>
                            <td>O+</td>
                            <td>Falabella</td>
                            <td>Italia</td>
                            <td>Contador</td>
                            <td>3143214323</td>
                        </tr>
                        <tr>
                            <td>Martha Guilizzoni</td>
                            <td>1035443</td>
                            <td>B+</td>
                            <td>Falabella</td>
                            <td>Italia</td>
                            <td>Estudiante</td>
                            <td>3103213198</td>
                        </tr>
                    </table>
                    <br>
                </div>
            </div>
        </div>
        
        <div class="button-return">
            <a href="/historial_habitacion/index.php">Regresar</a>
        </div>
    </div>
    
	<div id="aux-footer" class="col-12"></div>
	<footer>
        <a href="/home/index.php" class="info">Hotel Aristo</a> &copy; 2019 | Todos los derechos reservados
    </footer>
</body>
</html>