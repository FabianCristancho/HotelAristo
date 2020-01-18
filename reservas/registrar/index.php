<?php
    /**
    * Archivo que contiene un formulario para el registro de una nueva reserva
    * @package   reservas.registrar
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación de las clases requeridas para el buen funcionamiento de la aplicación
    */
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
    <!--Importación de librerias css y javascript -->
	<head>
		<link rel="shortcut icon" href="/res/img/famicon.png" />
		<title>Nueva reserva | Hotel Aristo</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/form.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" type="text/css" href="/css/modal.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="/js/moment.js"></script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/dynamic.js"></script>
		<script type="text/javascript" src="/js/hotel-db.js"></script>
	</head>

    <!--Construcción de la vista-->
	<body onload ="getDate('start-date',0); getDate('finish-date',1); assignAttributes();">
      <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "registrar"
            */
            setCurrentPage("registrar");
        </script>
        
        <!--Contiene el formulario de registro correspondiente para una empresa-->
		<div class="content col-12 padd">
			<div class="wrap-main wrap-main-big col-10 wrap-10 padd">
				<div class="content-header">
                    <h2 class="title-form">REGISTRAR RESERVA</h2>
                </div>
				<div class="row">
					<div class="col-6 padd">
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
								<div class="row">
									<div class="form-group in-row">
										<label class="form-control-label">Cantidad de habitaciones</label>
										<div class="input-group">
											<div class="input-group-icon">
												<i class="fa fa-bed"></i>
											</div>
											<input type="number" class="form-control" min="1" value="1">
										</div>
										<small class="form-text text-muted">ej. 1</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 padd">
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
						                        <option value="1">1 PAX</option>
						                        <option value="1">2 PAX</option>
						                    </select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 padd row-simple">
						<?php 
							include "../../objects/input-client.php";
							include "../../objects/input-client.php"; 
							include "../../objects/input-client.php";
							include "../../objects/input-client.php"; 
						?>
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
		<div id="add-bizz" class="modal" onclick="touchOutside(this);">
			<div class="modal-content">
                <div class="modal-header">
                    <span onclick="hideModal('add-bizz');" class="close">&times;</span>
                    <h2>Agregar empresa</h2>
                </div>
                <div class="modal-body">
                	<?php include "../../objects/input-enterprise.php"; ?>
                	<div>
						<button class="btn btn-block btn-register"  onclick="updateEnterprise();">
							<i class="fa fa-check"></i>
							<span>Registrar empresa</span>
						</button>
					</div>
                </div>
            </div>
		</div>
		<div id="add-prof" class="modal" onclick="touchOutside(this);";>
			<div class="modal-content">
                <div class="modal-header">
                    <span onclick="hideModal('add-prof');" class="close">&times;</span>
                    <h2>Agregar profesión</h2>
                </div>
                <div class="modal-body">
                	<?php include "../../objects/input-profession.php"; ?>
                	<div>
						<button class="btn btn-block btn-register" onclick="updateProfession();">
							<i class="fa fa-check"></i>
							<span>Registrar profesión</span>
						</button>
					</div>
                </div>
            </div>
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