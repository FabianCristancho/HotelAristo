<?php
     include 'database.php';
    
    switch ($_POST['action']) {
        case 'setCheckOn':
            setCheckOn();
            break;
        case 'deleteBooking':
            deleteBooking();
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