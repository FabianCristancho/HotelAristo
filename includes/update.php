<?php
     include 'database.php';
    
    switch ($_POST['action']) {
        case 'setCheckOn':
            setCheckOn();
            break;
        case 'deleteBooking':
            deleteBooking();
            break;
        case 'setCheckUp':
            setCheckUp();
            break;
        case 'setCheckOut':
            setCheckOut();
            break;
    }

    function setCheckOn(){
        $database=new Database();

        $update="UPDATE reservas SET estado_reserva = 'RE',fecha_ingreso = '".date('Y-m-d H:i:s')."'";

        if(isset($_POST['paymentMethod'])){
            $update=$update." ,medio_pago='".$_POST['paymentMethod']."', abono_reserva=".$_POST['amount'];
        }

        
        $update=$update." WHERE id_reserva = :idBooking";

        $query=$database->connect()->prepare($update);

        try{
            $query->execute([':idBooking'=>$_POST['idBooking']]);
            echo 'alert-s;Se ha cambiado el estado de la reserva.';
        }catch(PDOException $e){
            echo 'alert-d;Error U3.1. Error al actualizar estado de la reserva'.$update.$e->getMessage();
        }
    }

    function setCheckUp(){
        $database=new Database();

        $data=explode("?", $_POST['values']);
        $success=true;

        for ($i=0; $i < count($data)-1; $i++) { 
            $values=explode("_", $data[$i]);
            $update="UPDATE registros_huesped SET estado_huesped = '".$values[1]."' WHERE id_registro_huesped=".$values[0];
             $query=$database->connect()->prepare($update);
            try{
                $query->execute();
            }catch(PDOException $e){
                $success=false;
            }
        }
       

        if($success){
           
            echo 'alert-s;Se ha cambiado el estado de los huespedes de esta habitacion.';
        }else{
            echo 'alert-d;Error U5.1. Error al cambiar el estado de algun huesped'.$e->getMessage();
        }
    }

    function setCheckOut(){
        $database=new Database();

        $update="UPDATE reservas SET estado_reserva = 'TE',fecha_salida = '".date('Y-m-d H:i:s')."'";
        
        $update=$update." WHERE id_reserva = :idBooking";

        $query=$database->connect()->prepare($update);

        try{
            $query->execute([':idBooking'=>$_POST['idBooking']]);
            echo 'alert-s;Se ha cambiado el estado de la reserva.';
        }catch(PDOException $e){
            echo 'alert-d;Error U3.1. Error al actualizar estado de la reserva'.$update.$e->getMessage();
        }
    }

    function deleteBooking(){
        $database=new Database();

        $queryRH=$database->connect()->prepare("SELECT id_registro_habitacion FROM registros_habitacion WHERE id_reserva=".$_POST["id"]);
        $queryRH->execute();

        foreach ($queryRH as $current) {
            $database->connect()->exec("DELETE FROM registros_huesped WHERE id_registro_habitacion =".$current['id_registro_habitacion']);
        }

        $database->connect()->exec("DELETE FROM registros_habitacion WHERE id_reserva=".$_POST['id']);
        $query=$database->connect()->prepare("DELETE FROM reservas WHERE id_reserva=".$_POST['id']);

        try{
            $query->execute();
            echo 'alert-s;Se ha eliminado la reserva.';
        }catch(PDOException $e){
            echo 'alert-d;Error D3.1. Error al eliminar la reserva'.$e->getMessage();
        }
    }


?>