<!DOCTYPE html>
<html>
	<head>
		<title>Test Notificacione</title>
		<script src="notifications.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="manifest" href="/manifest.json">
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/dynamic.js"></script>
	</head>
	<body>
		<button style="width: 100%; height: 100px;" onclick="window.location.href='';">Refresh</button>
		<form onsubmit="askPermission(); return false;">
			<input type="text" name="name" required>
			<button>Suscribirse</button>
		</form>
		<form onsubmit="return false;">
			<label>Titulo</label>
			<input type="text" name="title">
			<label>Contenido</label>
			<textarea rows="4"></textarea>
			<label>Dispositivo</label>
			<select>
				<option value="ALL">Todos</option>
				<?php 
					/**
					 * Llama al script que solicit la informacion de las suscripciones
					*/
					include 'consult.php';
				?>
			</select>
			<button onclick="sendCustomMessage();">Enviar</button>
		</form>
				
		<?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/alerts.php";
        ?>
	</body>
</html>

