<?php
    include 'database.php';

    switch($_POST['entity']){
        case 'roomType':
        roomTypeList($_POST['roomType']);
        break;
        case 'enterprise':
        enterpriseList();
        break;
        case 'country':
        cityList($_POST['country']);
        break;
        case 'profession':
        professionList();
        break;
    }

    function professionList(){
        $database=new Database();
        $query = $database->connect()->prepare('SELECT id_profesion,nombre_profesion FROM profesiones');
        $query->execute();
        foreach ($query as $current) {
            echo '<option value="'.$current['id_profesion'].'">'.$current['nombre_profesion'].'</option>';
        }
    }

    function cityList($country){
        $database=new Database();
        $query = $database->connect()->prepare('SELECT id_lugar,nombre_lugar FROM lugares WHERE tipo_lugar="C" AND id_ubicacion='.$country);
        $query->execute();
        foreach ($query as $current) {
            echo '<option value="'.$current['id_lugar'].'">'.$current['nombre_lugar'].'</option>';
        }
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