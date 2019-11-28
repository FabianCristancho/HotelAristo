<?php
    include 'database.php';

    switch($_POST['entity']){
        case 'roomType':
        roomTypeList($_POST['roomType']);
        break;
        case 'enterprise':
        	enterpriseList();
        	break;
    }

	function roomTypeList($type){
    	$database=new Database();
        $query = $database->connect()->prepare('SELECT numero_habitacion FROM habitaciones WHERE estado_habitacion="D" AND tipo_habitacion='.'"'.$type.'"');
        $query->execute();
        foreach ($query as $current) {
            echo '<option value="'.$current['numero_habitacion'].'">'.$current['numero_habitacion'].'</option>';
        }
    }

    function enterpriseList(){
    	$database=new Database();
        $query = $database->connect()->prepare('SELECT id_empresa,nombre_empresa FROM empresas');
        $query->execute();
        foreach ($query as $current) {
            echo '<option value="'.$current['id_empresa'].'">'.$current['nombre_empresa'].'</option>';
        }
    }


?>