<?php
    include 'database.php';
    
    switch ($_POST['entity']) {
    	case 'reservation':
    	   insertReservation();
    	   break;
        case "customer":
            insertCustomer();
            break;
        case 'enterprise':
            insertEnterprise();
            break;
        case 'profession':
            insertProfession();
            break;
        case 'saveBill':
            insertBill($_POST['idBook'], $_POST['typeBill'], $_POST['totalBill'], $_POST['currentUser']);
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
        
        $nit=$_POST["nit"];
        $name=$_POST["name"];
        $phone=$_POST["phone"];
        $email=$_POST["email"];
        $ret=$_POST["ret"];
        $other=$_POST["other"];

        $insert ="INSERT INTO empresas( nit_empresa, nombre_empresa, correo_empresa, telefono_empresa, retefuente, otro_impuesto) VALUES
                ('".$nit."','".$name."','".$email."','".$phone."',".$ret.",".$other.");";
        try{
            $database->connect()->exec($insert);
            echo 'alert-s;Se ha agregado a '.$name.' a la base de datos.';
        }catch(PDOException $e){
            echo 'alert-d;Error A2.1. Ha surgido un error al intentar agregar la empresa.';
        }
    }

    function insertCustomer(){
        $database=new Database();

        $fName=evaluateValue($_POST["fName"]);
        $lName=evaluateValue($_POST["lName"]);
        $phone=evaluateValue($_POST["phone"]);
        $email=evaluateValue($_POST["email"]);
        $enterprise=evaluateValue($_POST["enterprise"]);

        if($_POST["type"]=="A"){
            $docType=$_POST["docType"];
            $docNum=evaluateValue($_POST["docNum"]);
            $docDate=evaluateValue($_POST["docDate"]);
            $gender=$_POST["gender"];
            $birth=evaluateValue($_POST["birth"]);
            $blood_rh=$_POST["blood"].=$_POST["rh"];;
            $profession=evaluateValue($_POST["profession"]);
            $nac=$_POST["nac"];
            $docCity=$_POST["docCity"];

            $insert ="INSERT INTO personas( id_lugar_nacimiento, id_lugar_expedicion, nombres_persona, apellidos_persona,tipo_documento, numero_documento, genero_persona, fecha_nacimiento, tipo_sangre_rh, telefono_persona, correo_persona, id_empresa, id_profesion, tipo_persona) VALUES
                (".$nac.",".$docCity.",".$fName.",".$lName.",".$docType.",".$docNum.",".$gender.",".$birth.",".$blood_rh.",".$phone.",".$email.",".$enterprise.",".$profession.",'C');";

            try{
                $database->connect()->exec($insert);
                echo 'alert-s;Se ha agregado a '.$fName.' '.$lName.' a la base de datos.';
            }catch(PDOException $e){
                echo 'alert-d;Error A1.1. Ha surgido un error al intentar agregar al cliente.';
            }
        }else{
            $insert ="INSERT INTO personas( nombres_persona, apellidos_persona, telefono_persona, correo_persona, id_empresa,tipo_persona) VALUES 
            (".$fName.",".$lName.",".$phone.",".$email.",".$enterprise.",'C');";
            
            try{
                $database->connect()->exec($insert);
                echo 'alert-s;Se ha agregado a '.$fName.' '.$lName.' a la base de datos. Recuerde que los datos no estan completos';
            }catch(PDOException $e){
                echo 'alert-d;Error A1.2. Ha surgido un error al intentar agregar al cliente.'.$e->getMessage();
            }
        }
    }

    function evaluateValue($value){
        return $value!="NULL"?"'".$value."'":$value;
    }

    function insertReservation(){
    	$database=new Database();

        $startDate=$_POST['startDate'];
        $finishDate=$_POST['finishDate'];
        $countNights=$_POST['countNights'];
        $user=$_POST['user'];
        $roomId=$_POST['roomId'];
        $roomRate=$_POST['roomRate'];
        $countGuests=$_POST['countGuests'];

        if ($_POST['aux']=="N") {

            $docType; $docNum; $docDate; $enterprise; $fName;
            $lName; $phone; $email; $gender; $birth; $blood_rh; $profession; $nac;

            for ($i=1; $i <= $countGuests; $i++) { 
                $docType=$_POST['docType_'.$i];
                $docNum=$_POST['docNum_'.$i];
                $docDate=$_POST['docDate_'.$i];
                $enterprise=$_POST['enterprise_'.$i];
                $fName=$_POST['fName_'.$i];
                $lName=$_POST['lName_'.$i];
                $phone=$_POST['phone_'.$i];
                $email=$_POST['email_'.$i];
                $gender=$_POST['gender_'.$i];
                $birth=$_POST['birth_'.$i];
                $blood_rh=$_POST['blood_'.$i].$_POST['rh_'.$i];
                $profession=$_POST['profession_'.$i];
                $nac=$_POST['nac_'.$i];

                $insert ="INSERT INTO personas(id_lugar_nacimiento,id_lugar_expedicion,nombres_persona,apellidos_persona,tipo_documento,numero_documento,genero_persona,fecha_nacimiento,tipo_sangre_rh,telefono_persona,correo_persona,id_empresa,id_profesion,tipo_persona) VALUES
                (".$nac.","."51".",'".$fName."','".$lName."','".$docType."','".$docNum."','".$gender."','".$birth."','".$blood_rh."','".$phone."','".$email."',".$enterprise.",".$profession.",'C');";
            
                try{
                    $database->connect()->exec($insert);
                    echo 'alert-s;Se ha agregado a '.$fName.' '.$lName.' a la base de datos.';
                }catch(PDOException $e){
                    echo 'alert-d;Error A1.3. Ha surgido un error al intentar agregar al cliente.';
                }
            }
        }else{

            $enterprise; $fName; $lName; $phone; $email; 

            for ($i=1; $i <= $countGuests; $i++) { 
                $enterprise=$_POST['enterprise_'.$i];
                $fName=$_POST['fName_'.$i];
                $lName=$_POST['lName_'.$i];
                $phone=$_POST['phone_'.$i];
                $email=$_POST['email_'.$i];
                $profession=$_POST['profession_'.$i];

                $insert ="INSERT INTO personas_auxiliares(nombres_persona,apellidos_persona,telefono_persona,correo_persona,id_empresa) VALUES
                ('".$fName."','".$lName."','".$phone."','".$email."',".$enterprise.");";
            
                try{
                    $database->connect()->exec($insert);
                    echo 'alert-s;Se ha agregado a '.$fName.' '.$lName.' a la base de datos. Recuerde que los datos no estan completos';
                }catch(PDOException $e){
                    echo 'alert-d;Error A1.4. Ha surgido un error al intentar agregar al cliente.';
                }
            }
        }
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


?>