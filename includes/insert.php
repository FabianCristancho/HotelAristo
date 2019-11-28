<?php
    include 'database.php';

    switch ($_POST['entity']) {
    	case 'reservation':
    	insertReservation();
    	break;
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

                $insert ="INSERT INTO personas(id_lugar_nacimiento,id_lugar_expedicion,nombres_persona,apellidos_persona,tipo_documento,numero_documento,genero_persona,fecha_nacimiento,tipo_sangre_rh,telefono_persona,correo_persona) VALUES
                (".$nac.","."51".",'".$fName."','".$lName."','".$docType."','".$docNum."','".$gender."','".$birth."','".$blood_rh."','".$phone."','".$email."');";
            
                try{
                    $database->connect()->exec($insert);
                    echo 'Registro persona exitoso';
                }catch(PDOException $e){
                    echo $e;
                }

                $query=$database->connect()->prepare("SELECT id_persona FROM personas WHERE numero_documento=".$docNum);
                $query->execute();

                $id_person;
                foreach ($query as $current) {
                    $id_person=$current['id_persona'];
                }

                $insert ="INSERT INTO clientes (id_persona, id_empresa,id_profesion) VALUES 
                (".$id_person.",".$enterprise.",".$profession.")";
                
                try{
                    $database->connect()->exec($insert);
                    echo 'Registro cliente exitoso';
                }catch(PDOException $e){
                    echo $e;
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

                $insert ="INSERT INTO personas_auxiliares(nombres_persona,apellidos_persona,telefono_persona,correo_persona) VALUES
                ('".$fName."','".$lName."','".$phone."','".$email."');";
            
                try{
                    $database->connect()->exec($insert);
                    echo 'Registro persona exitoso aux';
                }catch(PDOException $e){
                    echo $e;
                }

                $query=$database->connect()->prepare("SELECT id_persona_aux FROM personas_auxiliares WHERE telefono_persona='".$phone."'");
                $query->execute();

                $id_person;
                foreach ($query as $current) {
                    $id_person=$current['id_persona_aux'];
                }

                $insert ="INSERT INTO clientes (id_persona_aux, id_empresa,id_profesion) VALUES 
                (".$id_person.",".$enterprise.",".$profession.")";
                
                try{
                    $database->connect()->exec($insert);
                    echo 'Registro cliente exitoso';
                }catch(PDOException $e){
                    echo $e;
                }
            }
        }

        
    }


?>