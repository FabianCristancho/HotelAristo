<?php
    include_once '../includes/database.php';
    include_once '../includes/consult.php';
    $consult=new Consult();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Empresas registradas | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/img/famicon.png" />
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/main-800.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1024.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="../css/alerts.css">
	<script type="text/javascript" src="../js/moment.js"></script>
	<script type="text/javascript" src="../js/dynamic.js"></script>
</head>

<body>
    <?php
        include "../objetos/menu.php"; 
    ?>
    <script type="text/javascript">
        setCurrentPage("consultar");
    </script>

	<div id="content" class="col-12">

		<div class="marco nearly-page">
            <h1>EMPRESAS REGISTRADAS</h1>
            <div class="scroll-block">
                <table>
                    <thead>
                        <tr>
                            <th>NIT</th>
                            <th>NOMBRE</th>
                            <th>TELEFONO</th>
                            <th>RETEFUENTE (3,5 %)</th>
                            <th>OTRO IMPUESTO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                        $consult->getTable('enterprise');
                    ?>
                </table>
            </div>
		</div>
	</div>
	<div id="aux-footer" class="col-12"></div>
	<?php include "../objetos/pie.php"; ?>

</body>
</html>
