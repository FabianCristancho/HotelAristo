<?php
     include 'database.php';
    
    switch ($_POST['action']) {
        case 'setCheckOn':
            setCheckOn();
            break;
    }

    function setCheckOn(){
        $database=new Database();

        $update="UPDATE reservas SET estado_reserva = 'RE',fecha_ingreso = '".date('Y-m-d H:i:s')."' WHERE id_reserva = :idBooking";
        $query=$database->connect()->prepare($update);

        try{
            $query->execute([':idBooking'=>$_POST['idBooking']]);
            echo 'alert-s;Se ha cambiado el estado de la reserva.';
        }catch(PDOException $e){
            echo 'alert-d;Error U3.1. Error al actualizar estado de la reserva'.$e->getMessage();
        }

    }


?>