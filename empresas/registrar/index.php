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

	<body>
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
				<h2>REGISTRAR EMPRESA</h2>
				<div class="row">
					<div class="col-12">
						<?php
				            include "../../objects/input-enterprise.php";
				        ?>
					</div>
				</div>
				<div>
					<button class="btn btn-block btn-register" onclick="sendEnterprise();">
						<i class="fa fa-check"></i>
						<span>Registrar empresa</span>
					</button>
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