<?php 
    require_once("consult.php");
    $button = $_POST['button'];

    if($button==='update'){
        $inst = new Consult();
        
        $idPerson = $_POST['id'];
        $typeDoc = $_POST['typeDoc'];
        $numberDoc = $_POST['numberDoc'];
        $placeExp = $_POST['placeExp'];
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $birthDate = $_POST['birthDate'];
        $typeBlood = $_POST['typeBlood'];
        $rh = $_POST['rh'];
        $profession = $_POST['profession'];
        $nationality = $_POST['nationality'];
        
        if($inst->updateDataCustomers($idPerson, $placeExp, $name, $lastName, $typeDoc, $numberDoc, $gender, $birthDate, $typeBlood, $rh, $phone, $email, $profession)){
            echo 'Datos actualizados con exito';
        }else{
            echo 'No se pudo actualizar';
        }
    }

?>