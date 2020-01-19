<!DOCTYPE html>
<html>
	<head>
		<title>Test alertas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="/js/dynamic.js"></script>
		
	</head>
	<body class="col-12">
		<?php include "../objects/alerts.php"; ?>
		<button onclick="showAlert('alert-s','Hola');" >Exito</button>
		<button onclick="showAlert('alert-i','Hola');" >Información</button>
		<button onclick="showAlert('alert-w','Hola');" >Precaición</button>
		<button onclick="showAlert('alert-d','Hola');" >Error</button>
	</body>
</html>