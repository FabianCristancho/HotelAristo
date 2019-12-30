	<!DOCTYPE html>
	<html>
	<!--Importación de librerias css y javascript -->
	<head>
		<title>Control por Habitación | Hotel Aristo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/res/img/famicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/main-800.css">
		<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
		<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" type="text/css" href="/css/modal.css">
		<script type="text/javascript" src="/js/moment.js"></script>
		<script type="text/javascript" src="/js/dynamic.js"></script>
	</head>

	<!--Construcción de la vista-->

	<body onload ="getDate('start-date',0); getDate('finish-date',1);">
	<!--Menu de la aplicación web del hotel Aristo
		la clase main-menu-item pertenece a los botones del menú-->
		<?php include "../../menu/menu.php"; ?>
        <script type="text/javascript">
            setCurrentPage("control-diario");
        </script>
		<!--El bloque de contenido es la vista principal de cada pagina
			puede contener varias clases marco, que distribuyen la informacion.
			Si existe un formulario cada dato para introducir es colocado en una clase input-block
			que contiene una etiqueta y una entrada de informacion-->

			<div id="content" class="col-12">
				<div style="float: left;" class="marco responsive-page">
                    <h3><b>Habitación</b></h3>
                    <div class="input-block">
						<label><b>Número de Habitación</b></label>
				        <br><br>
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

					<div class="input-block">
                        <label><b>Tipo de Habitación</b></label>
                        <br><br>
                        <label>Lispector</label>
				    </div>

					<div class="input-block">
						<label><b>Estado</b></label>
						<br><br>
                        <label>Ocupada</label>
					</div>
                    <div class="input-block">
						<label><b>Saldo Total ($)</b></label>
						<br><br>
                        <label>320.000</label>
					</div>
                    <div class="input-block">
						<a href="#" id="button-more-info" class="col-10">Efectuar Pago</a>
					</div>
				</div>

				<div class="marco responsive-page">
                    <div>
                        <h3><b>Huéspedes</b></h3>
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
                    
					<div class="input-block">
                        <label><b>Conteo días</b></label>
                        <br><br>
                        <label>1 de 4</label>
				    </div>

					<div class="input-block">
						<label><b>Hora Ingreso</b></label>
						<br><br>
                        <label>Ocupada</label>
					</div>
                    <div class="input-block">
						<label><b>¿Huésped se encuentra en habitación?</b></label>
						<br><br>
                        <input type="radio" name="ocupacion" value="Presencia" checked>Sí
                        <input type="radio" name="ocupacion" value="Ausencia">No
					</div>
				</div>

                
				<div  class="marco responsive-page">
                    <h3><b>Consumo de Servicios</b></h3>
					<div class="input-block">
                        <label><b>Valor consumo en minibar ($)</b></label>
                        <input class="col-12" type="text" placeholder="Valor en Minibar">
                        <br><br>
				    </div>
                    <div class="input-block">
                        <label><b>Valor consumo en lavandería ($)</b></label>
                        <input class="col-12" type="text" placeholder="Valor en Lavandería">
                        <br><br>
				    </div>
                    <div class="input-block">
                        <label><b>Valor consumo en restaurante ($)</b></label>
                        <input class="col-12" type="text" placeholder="Valor en Restaurante">
                        <br><br>
				    </div>
                    <div class="input-block">
                        <label><b>Valor consumo en adicional ($)</b></label>
                        <input class="col-12" type="text" placeholder="Valor Adicional">
                        <br><br>
				    </div>
                    <div class="input-block">
                        <label><b>Saldo de consumo ($)</b></label>
                        <input class="col-12" type="text" placeholder="Saldo">
                        <br><br>
				    </div>
                    <div class="input-block">
                        <label><b>Observaciones</b></label>
                        <textarea id="textarea-com" name="comentarios" rows="3" cols="30" placeholder="Escriba aquí información adicional"></textarea>
                        <br><br>
				    </div>
				</div>
        </div>
                

			

			<!--El bloque de alertas contiene cuatro tipos de alertas para darle al usuario
				visibilidad de los procesos. Se definieron: Peligro, Informacion, Precausion y Exito-->
				<div id="alerts">
					<div id="alert-d" class="alert danger">
						<span onclick="hideAlert('alert-d');" class="closebtn">&times;</span>  
						<strong>¡Peligro!</strong> 
						Mensaje muy largo con varias lineas de escritura, usado para probar como actuan los componentes cuando se sobrepasa su longitud horizontal
					</div>

					<div id="alert-s" class="alert success">
						<span onclick="hideAlert('alert-s');" class="closebtn">&times;</span>  
						<strong>¡Procedimiento exitoso!</strong> 
						Mensaje
					</div>

					<div id="alert-i" class="alert info">
						<span onclick="hideAlert('alert-i');" class="closebtn">&times;</span>  
						<strong>Información!</strong> 
						Mensaje
					</div>

					<div id="alert-w" class="alert warning">
						<span onclick="hideAlert('alert-w');" class="closebtn">&times;</span>  
						<strong>¡Precaución!</strong> 
						Mensaje muy largo con varias lineas de escritura, usado para probar como actuan los componentes cuando se sobrepasa su longitud horizontal
					</div>
				</div>
                <footer>
                    <a href="/home/index.php" class="info">Hotel Aristo</a> &copy; 2019 | Todos los derechos reservados
                </footer>
			</body>
</html>
