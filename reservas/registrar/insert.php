<?php 

	require '../../includes/database.php';

	switch ($_POST['entity']) {
		case 'reservation':
			insertReservation();
			break;
		case 'room':
			insertRoom();
			break;
		case 'person':
			insertPerson();
			break;
		case 'guestReg':
			insertGuestBook();
			break;
	}


	function insertPerson(){
		$database= new Database();

		$insert='INSERT INTO personas(nombres_persona, apellidos_persona, telefono_persona,correo_persona,tipo_persona';
		$values="'".$_POST['firstSecondName']."','".$_POST['lastName']."','".$_POST['phone']."',".(isset($_POST['email'])?"'".$_POST['email']."'":"NULL").",'C'";

		if(isset($_POST["docNumber"])){
			$insert=$insert.',id_lugar_nacimiento,id_lugar_expedicion,tipo_documento,numero_documento,genero_persona,fecha_nacimiento,tipo_sangre_rh';
			$values=$values.",".$_POST['nationality'].",".$_POST['docCity'].",'".$_POST['docType']."','".$_POST['docNumber']."','".$_POST['gender']."','".$_POST['bornDate']."','".str_replace(" ", "+", $_POST['bloodRh'])."'";
			if(isset($_POST['profession'])){
				$insert=$insert.",id_profesion";
				$values=$values.",".$_POST['profession'];
			}
		}

		$insert=$insert.")\n VALUES (".$values.');';
		$database->connect()->exec('ALTER TABLE personas AUTO_INCREMENT = 1');

		try{
			$pdo=$database->connect();
			$query=$pdo->exec($insert);
			echo $pdo->lastInsertId().';Se ha insertado a '.$_POST['firstSecondName'].' '.$_POST['lastName'];
		}catch(PDOException $e){
			echo 'null;Error C1.1. Error al ingresar nuevo cliente'.$insert."\n".$e->getMessage();
		}

		$database->connect()->exec('ALTER TABLE personas AUTO_INCREMENT = 1');
	}

	function insertRoom(){
		$database= new Database();

		$insert='INSERT INTO registros_habitacion(id_reserva, id_habitacion, id_tarifa, estado_registro';
		$values=$_POST['bookingId'].",".$_POST['roomNumber'].",".$_POST['tariff'].",'CI'";


		$insert=$insert.")\n VALUES (".$values.');';
		$database->connect()->exec('ALTER TABLE registros_habitacion AUTO_INCREMENT = 1');

		try{
			$pdo=$database->connect();
			$query=$pdo->exec($insert);
			echo $pdo->lastInsertId().';Se ha asignado una habitacion a la reserva.';
		}catch(PDOException $e){
			echo 'null;Error C2.1. Error al ingresar nuevo registro'."\n".$insert.$e->getMessage();;
		}

		$database->connect()->exec('ALTER TABLE registros_habitacion AUTO_INCREMENT = 1');
	}

	function insertReservation(){
		$database= new Database();
		$insert='INSERT INTO reservas (fecha_ingreso, fecha_salida,id_usuario,estado_reserva, estado_pago_reserva,valor_pagado,saldo';
		$values=($_POST['state']=="RE"?"'".date('Y-m-d H:i:s')."'":"'".$_POST['startDate']."'").",'".$_POST['finishDate']."',".$_POST['user'].",'".$_POST['state']."','P',0,".$_POST['amount'];

		if(isset($_POST['holder'])){
			$insert=$insert.",id_titular";
			$values=$values.",".$_POST['holder'];
		}else{
			$insert=$insert.",id_empresa";
			$values=$values.",".$_POST['enterprise'];
		}

		if(isset($_POST['paymentMethod'])){
			$insert=$insert.",medio_pago";
			$values=$values.",'".$_POST['paymentMethod']."'";
		}

		$insert=$insert.")\n VALUES (".$values.");";
		$database->connect()->exec('ALTER TABLE reservas AUTO_INCREMENT = 1');

		try{
			$pdo=$database->connect();
			$query=$pdo->exec($insert);
			$idBooking=$pdo->lastInsertId();
			echo $idBooking.';'.(isset($_POST['holder'])?$_POST['holder']:$_POST['enterprise']).';Se ha registrado una nueva reserva.';
		}catch(PDOException $e){
			echo 'null;Error C3.1. Error al ingresar nueva reserva'.$e->getMessage()."\n".$insert;
		}

		$database->connect()->exec('ALTER TABLE reservas AUTO_INCREMENT = 1');
	}

	function insertGuestBook(){
		$database= new Database();

		$insert='INSERT INTO registros_huesped (id_registro_habitacion,id_huesped';
		$values=$_POST['roomReg'].",".$_POST['guestId'];

		$insert=$insert.")\n VALUES (".$values.");";
		$database->connect()->exec('ALTER TABLE registros_huesped AUTO_INCREMENT = 1');

		try{
			$pdo=$database->connect();
			$query=$pdo->exec($insert);
			echo $pdo->lastInsertId().';Se ha asignado un huesped a la reserva.';
		}catch(PDOException $e){
			echo 'null;Error C3.1. Error al ingresar nuevo registro'.$e->getMessage().'\n'.$insert;
		}

		$database->connect()->exec('ALTER TABLE registros_huesped AUTO_INCREMENT = 1');
	}

?>