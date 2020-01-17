<?php 
	include '../../includes/database.php';
	$database=new Database();
	$database->connect()->exec('ALTER TABLE usuarios_aplicacion AUTO_INCREMENT = 1');
	
	$insert ='INSERT INTO usuarios_aplicacion(nombre_usuario,endpoint, llave_publica, llave_autorizacion ) VALUES ('.$_POST["name"].','.$_POST["endpoint"].','.str_replace(" ", "+", $_POST["publicKey"]).','.str_replace(" ", "+",$_POST["authKey"]).');';
	
	try{
		$database->connect()->exec($insert);
		echo 'alert-s;Se ha agregado la suscripción de '.$_POST["name"].' a la aplicacación web del Hotel Aristo';
	}catch(PDOException $e){
		echo 'alert-i;Ya esta suscrito';
	}
	$database->connect()->exec('ALTER TABLE usuarios_aplicacion AUTO_INCREMENT = 1');
?>