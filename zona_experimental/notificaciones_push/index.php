<!DOCTYPE html>
<html>
	<head>
		<title>Test Notificacione</title>
		<script src="notifications.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/form.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
		<link rel="manifest" href="/manifest.json">
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/dynamic.js"></script>
	</head>
	<body class="col-12">
		<div class="wrap-main wrap-main-big col-10 wrap-10 padd">
			<div class="row">
				<div class="col-6 padd">
					<div class="card">
						<div class="card-header">
							<strong class="card-title">Suscripción</strong>
						</div>
						<div class="card-body">
							<form onsubmit="askPermission(); return false;">
								<div class="form-group">
									<label class="form-control-label">Nombre de suscripción</label>
									<div class="input-group">
										<div class="input-group-icon">
											<i class="fa fa-dollar"></i>
										</div>
										<input type="text" class="form-control">
									</div>
								</div>
							</form>
						</div>
						<button>Suscribirse</button>
					</div>
				</div>
				<div class="col-6 padd">
					<div class="card">
						<div class="card-header">
							<strong class="card-title">Enviar mensaje</strong>
						</div>
						<div class="card-body">
							<form onsubmit="return false;">
								<div class="form-group in-row">
									<label class="form-control-label">Titulo</label>
									<div class="input-group">
										<div class="input-group-icon">
											<i class="fa fa-dollar"></i>
										</div>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group in-row">
									<label class="form-control-label">Mensaje</label>
									<div class="input-group">
										<div class="input-group-icon">
											<i class="fa fa-dollar"></i>
										</div>
										<textarea class="form-control"></textarea>
									</div>
								</div>
								<div class="form-group in-row">
									<label class="form-control-label">Tipo de habitación</label>
									<div class="input-group">
										<div class="input-group-icon">
											<i class="fa fa-dollar"></i>
										</div>
										<select id="room-type" class="form-control" onchange="updateRooms();">
											<?php 
												/**
												 * Llama al script que solicit la informacion de las suscripciones
												*/
												include 'consult.php';
											?>
											<option value="ALL" selected>Todos</option>
										</select>
									</div>
								</div>
							</form>
						</div>
						<button onclick="sendCustomMessage();">Enviar</button>
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

