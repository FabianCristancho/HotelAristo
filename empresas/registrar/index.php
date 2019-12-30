<!DOCTYPE html>
<html>
<head>
	<title>Registro de empresas | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/res/img/famicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/register.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/main-800.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
    <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="/css/alerts.css">
	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/dynamic.js"></script>
</head>

<body>
        <?php include "../../menu/menu.php"; ?>
        <script type="text/javascript">
            setCurrentPage("registrar");
        </script>
    
    <div class="contenedor-formulario">
        <div class="wrap">
            <!-- Formulario -->
            <form action="" class="formulario" name="formulario_registro" method="post">  
                <div>
                    <h2>REGISTRAR EMPRESA</h2>
                    <div class="line-group">
                        <div class="input-group">
                            <input type="text" id="nit" name="nit" required>
                            <label class="label" for="nit">NIT*</label>
                        </div>
                        <div class="input-group">
                            <input type="text" id="name" name="name" required>
                            <label class="label" for="name">Nombre de la empresa*</label>
                        </div>
                    </div>

                    <div class="line-group">
                        <div class="input-group">
                            <input type="text" id="phone" name="phone" required>
                            <label class="label" for="phone">Teléfono*</label>
                        </div>
                    
                        <div class="input-group">
                            <input type="email" id="email" name="email">
                            <label class="label" for="email">Correo electrónico</label>
                        </div>
                    </div>

                    <div class="line-group">
                        <div class="input-group">
                            <label class="label_radio" for="retefuente">Retefuente (3,5%)*</label>
                            <p class="radio-text"><input type="radio" name="retefuente" value="Si" required>Si</p>
                            <p class="radio-text"><input type="radio" name="retefuente" value="No">No</p>
                        </div>
                        <div class="input-group">
                            <label class="label_combo" for="otro-impuesto">Otro impuesto</label>
                            <select id="otro-impuesto" class="combo">
                                <option value="NULL">Ninguno</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" id="btn-submit" value="Registrar">
                </div>
            </form>
        </div>
        
    </div>
				
	<div id="aux-footer" class="col-12"></div>
	<footer>
        <a href="/home/index.php" class="info">Hotel Aristo</a> &copy; 2019 | Todos los derechos reservados
    </footer>
</body>
</html>
        
        