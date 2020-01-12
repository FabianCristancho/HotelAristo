<?php
	require_once '../../includes/classes.php';
    $consult=new Consult();
	$userSession = new UserSession();
    $user = new User();
    if(isset($_SESSION['user'])){
    	$user->updateDBUser($userSession->getSession());
    }else{
    	header('location: /login');
    }
?>
<html>
	<head>
		<link rel="shortcut icon" href="/res/img/famicon.png" />
		<title>Nueva reserva | Hotel Aristo</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/main-800.css">
		<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
		<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
		<link rel="stylesheet" type="text/css" href="/css/form.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" type="text/css" href="/css/modal.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="/js/moment.js"></script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/dynamic.js"></script>
		<script type="text/javascript" src="/js/hotel-db.js"></script>
	</head>

	<body onload ="getDate('start-date',0); getDate('finish-date',1);">
		    <!--Menu de la aplicación web del hotel Aristo la clase main-menu-item pertenece a los botones del menú-->
      <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>
        <script type="text/javascript">
            setCurrentPage("registrar");
        </script>
		<div class="content col-12">
			<div class="wrap-main wrap-main-big col-10 wrap-10">
				<h2>REGISTRAR RESERVA</h2>
				<div class="row">
					<div class="col-6">
						<div class="card">
							<div class="card-header">
								<strong class="card-title">Información primaria</strong>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group in-row">
										<label class="form-control-label">Fecha de llegada</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
											<input id="start-date" type="date" class="form-control">
										</div>
										<small class="form-text text-muted">ej. 01/01/2020</small>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Fecha de salida</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
											<input id="finish-date" type="date" class="form-control">
										</div>
										<small class="form-text text-muted">ej. 02/01/2020</small>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Cantidad de noches</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-moon-o"></i>
											</div>
											<input id="count-nights" type="number" class="form-control" min="1" value="1">
										</div>
										<small class="form-text text-muted">ej. 1</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="card">
							<div class="card-header">
								<strong class="card-title">Habitación</strong>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group in-row">
										<label class="form-control-label">Tipo de habitación</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bed"></i>
											</div>
											<select id="room-type" class="form-control" onchange="updateRooms();">
						                        <option value="J" selected>JOLIOT</option>
						                        <option value="H">HAWKING</option>
						                        <option value="L">LISPECTOR</option>
						                        <option value="M">MAKKAH</option>
						                    </select>
										</div>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Número de habitación</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bed"></i>
											</div>
											<select id="room-select" class="form-control" >
											 	<?php $consult->getList('roomType','J'); ?>
											</select>
										</div>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Numero de huespedes</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-group"></i>
											</div>
											<select id="cantidad-huespedes" class="form-control" onchange ="updateGuest();">
						                        <option value="1">1 (Sencilla)</option>
						                        <option value="2">2 (Pareja)</option>
						                        <option value="2">2 (Doble)</option>
						                        <option value="3">3 (Triple)</option>
						                        <option value="4">3 (Triple + Sofacama)</option>
						                    </select>
										</div>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Tarifa de habitación</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-dollar"></i>
											</div>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="form-group in-row">
										<label class="form-control-label">Adicional</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-plus"></i>
											</div>
											<select id="adiconal" class="form-control">
						                        <option value="NULL">Ninguno</option>
						                    </select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card card-client">
							<div class="card-header">
								<strong class="card-title">Información personal</strong>
								<button onclick="showAllInputs(0);" class="check-in-cutton">Check in</button>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group in-row col-6">
										<label class="form-control-label">Nombres</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-user-o"></i>
											</div>
											<input id="first" class="form-control" type="text" placeholder="Nombres" required>
										</div>
										<small class="form-text text-muted">Pedro Luis</small>
									</div>
									<div class="form-group in-row col-6">
										<label class="form-control-label">Apellidos</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-user-o"></i>
											</div>
											<input id="last" class="form-control" type="text" placeholder="Apellidos" required>
										</div>
										<small class="form-text text-muted">ej. Perez Perez</small>
									</div>
								</div>
								<div class="hideable row">
									<div class="form-group in-row col-4">
										<label class="form-control-label">Tipo de documento</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-id-card"></i>
											</div>
											<select class="form-control" id="doc-type">
					                            <option value="CC">Cédula de ciudadania</option>
					                            <option value="RC">Registro civil</option>
					                            <option value="TI">Tarjeta de identidad</option>
					                            <option value="CE">Cedula de extranjeria</option>
					                        </select>
										</div>
									</div>
									<div class="form-group in-row col-5">
										<label class="form-control-label">Número de documento</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-id-card"></i>
											</div>
											 <input id="doc-num" class="form-control" type="text" placeholder="Número de documento" pattern="[0-9]{1,15}">
										</div>
										<small class="form-text text-muted">ej. 12345678</small>
									</div>
									<div class="form-group in-row col-3">
										<label class="form-control-label">Fecha de expedición</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
											<input id="doc-date" class="form-control" type="date">
										</div>
										<small class="form-text text-muted">ej. 10/12/2004</small>
									</div>
								</div>
								<div class="row hideable">
									<div class="form-group in-row col-7">
										<label class="form-control-label">Pais (Expedición)</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-map-marker"></i>
											</div>
											<select id="pais" class="form-control" onchange="updateCities();">
												<option value="51">Colombia</option>
												<?php $consult->getList('country',''); ?>
	                       					</select>
										</div>
									</div>
									<div class="form-group in-row col-5">
										<label class="form-control-label">Ciudad (Expedición)</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-map-marker"></i>
											</div>
											<select id="ciudad" class="form-control">
												<?php $consult->getList('city','51'); ?>
	                       					</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group in-row col-4">
										<label class="form-control-label">Telefono</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-phone"></i>
											</div>
											<input id="phone" class="form-control" type="tel" placeholder="Telefono" pattern="[0-9]{1,15}" required>
										</div>
										<small class="form-text text-muted">ej. 3123334466</small>
									</div>
									<div class="form-group in-row col-8">
										<label class="form-control-label">Correo</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-envelope"></i>
											</div>
											 <input id="email" class="form-control" type="email" placeholder="Correo electrónico">
										</div>
										<small class="form-text text-muted">ej. pedro.lopez@mail.com</small>
									</div>
								</div>
								<div class="row hideable">
									<div class="form-group in-row col-3">
										<label class="form-control-label">Genero</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-intersex"></i>
											</div>
					                        <select id="gender" class="form-control">
					                            <option value="M">Hombre</option>
					                            <option value="F">Mujer</option>
					                        </select>
					                    </div>
									</div>
									<div class="form-group in-row col-4">
										<label class="form-control-label">Fecha de nacimiento</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-calendar"></i>
											</div>
					                        <input id="birth" class="form-control" type="date">
					                    </div>
					                    <small class="form-text text-muted">ej. 22/09/1985</small>
									</div>
									<div class="form-group in-row col-5">
										<label class="form-control-label">Tipo de sangre</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-heartbeat"></i>
											</div>
					                        <select id="blood" class="form-control col-3">
					                            <option value="O">O</option>
					                            <option value="A">A</option>
					                            <option value="B">B</option>
					                            <option value="AB">AB</option>
					                        </select>
					                         <select id="rh" class="form-control col-9">
				                            	<option value="+">+ (Positivo)</option>
				                            	<option value="-">- (Negativo)</option>
				                       	 	</select>
				                       	 </div>
									</div>
								</div>
								<div class="row">
									<div class="hideable form-group in-row col-3">
										<label class="form-control-label">Profesión</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bank"></i>
											</div>
					                       <select id="profession" class="form-control">
					                            <option value="NULL">Ninguna</option>
					                            <?php $consult->getList('profession',''); ?>
					                        </select>
					                    </div>
									</div>
									<div class="form-group in-row col-3">
										<label class="form-control-label">Empresa</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bank"></i>
											</div>
					                       <select id="enterprise-1" class="form-control">
						                        <option value="NULL">NINGUNA</option>
						                        <?php $consult->getList('enterprise',''); ?>
						                    </select>
					                    </div>
									</div>
									<div class="hideable form-group in-row col-6">
										<label class="form-control-label">Nacionalidad</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-map-marker"></i>
											</div>
					                        <select id="nac" class="form-control">
					                        	<option value="51">Colombia</option>
					                            <?php $consult->getList('country',''); ?>
					                        </select>
					                    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div>
					<button class="btn btn-block btn-register">
						<i class="fa fa-check"></i>
						<span>Registrar reserva</span>
					</button>
				</div>
			</div>
		</div>
		<div class="modal">
			<?php 
            include "../../objects/input-enterprise.php"; ?>
		</div>
		<?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php";
            include "../../objects/alerts.php"; 
        ?>
	</body>
</html>