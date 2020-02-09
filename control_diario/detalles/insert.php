<?php
	require '../../includes/classes.php';
	$database= new Database();

	switch ($_POST['entity']) {
		case 'service':
		echo 'a';
			insertServiceTo();
			break;
	}


	function insertServiceTo(){
		$query = $database->connect()->prepare("SELECT id_control 
			FROM control_diario 
			WHERE id_registro_habitacion=:id_reg 
			AND fecha_control='".date('Y-m-d')."'");

        $query->execute([':id_reg'=>$_POST['idReg']]);

        foreach ($query as $current) {
            $id=$current['id_control'];
        }

        if(!isset($id)){
        	$insert='INSERT INTO control_diario(id_registro_habitacion,fecha_control';
			$values=$_POST['idReg'].",'".date('Y-m-d')."'";
			$insert=$insert.")\n VALUES (".$values.');';

			$database->connect()->exec('ALTER TABLE control_diario AUTO_INCREMENT = 1');

			try{
				$pdo=$database->connect();
				$query=$pdo->exec($insert);
				$id=$pdo->lastInsertId();
				echo $id.';Se ha insertado un servicio';
			}catch(PDOException $e){
				echo 'null;Error C1.1. Error al ingresar nuevo control'.$insert."\n".$e->getMessage();
			}

			$database->connect()->exec('ALTER TABLE control_diario AUTO_INCREMENT = 1');
        }

        $insert='INSERT INTO peticiones(id_control, id_servicio, estado_peticion, hora_peticion, valor_pagado, saldo, medio_pago, cantidad_producto';
		$values=$id.",".$_POST['idService'].",'C','".date('Y-m-d')."',".$_POST['paid'].",".$_POST['amount'].",'E',".$_POST['quantity'];
		$insert=$insert.")\n VALUES (".$values.');';

		$database->connect()->exec('ALTER TABLE peticiones AUTO_INCREMENT = 1');

        try{
	       	$pdo=$database->connect();
			$query=$pdo->exec($insert);
			echo $pdo->lastInsertId().';Se ha insertado un servicio';
		}catch(PDOException $e){
			echo 'null;Error C1.1. Error al ingresar nueva peticion'.$insert."\n".$e->getMessage();
		}

	}
?>