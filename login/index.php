<?php
	include_once '../includes/user.php';

	$userSession = new UserSession();
    $user = new User();
    $errorLogin='';

    if(isset($_SESSION['user'])){
    	$user->updateDBUser($userSession->getSession());
    	setHeader($user->getRole());
    }else if(isset($_POST['username']) && isset($_POST['password'])) {
    	$username = $_POST['username'];
    	$password = md5($_POST['password']);

    	if($user->exists($username,$password)){
    		$userSession->setSession($username);
    		$user->updateDBUser($username);
    		setHeader($user->getRole());
    	}else{
    		$errorLogin='Nombre de usuario o contraseña incorrecto';
    	}
    }

    function setHeader($role){
    	switch ($role) {
    		case 5:
    		header('location: ../inicio');
    			break;
    	}
    	
    }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/res/img/famicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/main-800.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
	<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="/css/alerts.css">
	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/dynamic.js"></script>
</head>
<body>
	<div id="content" class="col-12">
		<div id="login" class="wrap">
            <h2>INICIAR SESIÓN</h2>
            <div class="form-log">
                <form action="" method="POST">		
                    <?php echo '<p>'.$errorLogin.'</p>'; ?>
                    <div class="input-block-login">
                        <label>Nombre de usuario: </label>
                        <br>
                        <input type="text" name="username" placeholder="nombre.apellido" required>
                    </div>
                    <br>
                    <div class="input-block-login">
                        <label>Contraseña: </label>
                        <br>
                        <input type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit">Iniciar sesión</button>
                    <br>
                    <a href="#">¿Olvidó su contraseña?</a>
			     </form>
            </div>
		</div>
	</div>
	<div id="aux-footer" class="col-12"></div>
</body>
</html>