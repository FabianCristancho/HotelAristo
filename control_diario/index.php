<?php
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

<head>
	<title>Control diario | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/res/img/famicon.png" />
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/main-800.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="/css/alerts.css">
	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/dynamic.js"></script>
    <style type="text/css">
        td a:visited{
            color: white;
        }
    </style>
</head>

<body onload ="getDate('control-date',0); checkColors();">
        <?php include "../menu/menu.php"; ?>
        <script type="text/javascript">
            setCurrentPage("control-diario");
        </script>

	<div id="content" class="col-12">

		<div class="marco nearly-page">
            <h1>CONTROL DE HABITACIONES</h1>

            <div class="input-block-control">
					<label>Fecha control</label>
					<br>
                    <button>&lt;</button>
					<input id="control-date" type="date">
                    <button>&gt;</button>
            </div>

            <div class="scroll-block">
                <table>
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Tipo de habitación</th>
                        <th>Nombre huésped(es)</th>
                        <th>Fecha ingreso</th>
                        <th>Conteo diario</th>
                        <th>Total ($)</th>
                        <th>Check up</th>
                        <th>Check out</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                    $consult->getTable('room');
                ?>
            </table>
            </div>
		</div>
	</div>
	<div id="aux-footer" class="col-12"></div>
	<footer class="col-12">
		Hotel Aristo 2019
	</footer>

</body>
</html>
