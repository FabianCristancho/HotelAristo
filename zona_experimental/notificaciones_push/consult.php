<?php 
	include '../../includes/database.php';
	$database=new Database();

	$query = $database->connect()->prepare('SELECT id_usuario_aplicacion,nombre_usuario FROM usuarios_aplicacion');
    $query->execute();
    foreach ($query as $current) {
    	echo '<option value="'.$current['id_usuario_aplicacion'].'">'.$current['nombre_usuario'].'</option>';
    }
?>

