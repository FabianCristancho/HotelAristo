<?php
    include 'database.php';
    
    switch ($_POST['entity']) {
        case 'enterprise':
            insertEnterprise();
            break;
        case 'profession':
            insertProfession();
            break;
        case 'saveBill':
            insertBill($_POST['idBook'], $_POST['typeBill'], $_POST['totalBill'], $_POST['currentUser']);
            break;
        case 'saveUser':
            insertUser();
            break;
    }

    function insertProfession(){
        $database=new Database();
        
        $name=$_POST["name"];

        $insert ="INSERT INTO profesiones( nombre_profesion) VALUES
                ('".$name."');";
        try{
            $database->connect()->exec($insert);
            echo 'alert-s;Se ha agregado a '.$name.' a la base de datos.';
        }catch(PDOException $e){
            echo 'alert-d;Error A3.1. Ha surgido un error al intentar agregar la profesión.';
        }
    }

    function insertEnterprise(){
        $database=new Database();
        $database->connect()->exec("ALTER TABLE empresas AUTO_INCREMENT=1");
        $insert ="INSERT INTO empresas( nit_empresa, nombre_empresa, correo_empresa, telefono_empresa, retefuente,ica) VALUES
                ('".$_POST["nit"]."','".$_POST["name"]."','".$_POST["email"]."','".$_POST["phone"]."',".$_POST["ret"].",".$_POST["ica"].");";
        try{
            $database->connect()->exec($insert);
            echo 'alert-s;Se ha agregado a '.$_POST["name"].' a la base de datos.';
        }catch(PDOException $e){
            echo 'alert-d;Error A2.1. Ha surgido un error al intentar agregar la empresa.';
        }
    }

    function evaluateValue($value){
        return $value!="NULL"?"'".$value."'":$value;
    }
   

    function insertBill($idBook, $typeBill, $totalBill, $responsible){
        $database = new Database();
        $insert = "";
        date_default_timezone_set('America/Bogota');
        $dateBill = date("Y")."-".date("m")."-".date("d");
        if($typeBill==0)
            $insert = "CALL proc_serie(".$idBook.", '".$dateBill."', ".$totalBill.", ".$responsible.")";
        else{
            $insert = "CALL proc_orden_servicio(".$idBook.", '".$dateBill."', ".$totalBill.", ".$responsible.")";
        }
        try{
            $database->connect()->exec($insert);
            echo 'alert-s;Se ha generado la factura con éxito.';
        }catch(PDOException $e){
            echo $e->getMessage();
            echo 'alert-d;Error A4.1. Ha surgido un error al intentar agregar la factura';
        }
    }


    function insertUser(){
        $database = new Database();
        $insert = "INSERT INTO personas(nombres_persona, apellidos_persona, tipo_documento, numero_documento, telefono_persona, id_cargo, correo_persona, nombre_usuario, contrasena_usuario, tipo_persona) VALUES ('".$_POST['name']."','".$_POST['lastName']."','".$_POST['typeDocument']."','".$_POST['numberDocument']."','".$_POST['phone']."',".$_POST['role'].",'".$_POST['email']."','".$_POST['userName']."', md5('".$_POST['password']."'),'U')";
        try{
            $database->connect()->exec($insert);
            echo 'alert-s;Se ha almacenado al usuario con éxito.';
        }catch(PDOException $e){
            echo 'alert-d;Error A1.1. Ha surgido un error al intentar agregar al usuario';
        }
    }


?>