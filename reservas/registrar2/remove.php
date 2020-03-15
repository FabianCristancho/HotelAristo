<?php 
require '../../includes/database.php';

switch ($_POST['entity']) {
	case 'regRoom':
		removeRegRoom($_POST['id']);
		break;
	
	default:
		print_r($_POST);
		break;
}

function removeRegRoom($id){
	$database=new Database();

	$database->connect()->exec("DELETE FROM registros_huesped WHERE id_registro_habitacion =".$id);

    $query=$database->connect()->prepare("DELETE FROM registros_habitacion WHERE id_registro_habitacion=".$id);

    try{
        $query->execute();
        echo $id.';Se ha eliminado la habitacion.';
    }catch(PDOException $e){
        echo 'null;Error D1.1. Error al eliminar la habitacion'.$e->getMessage();
    }
}
?>