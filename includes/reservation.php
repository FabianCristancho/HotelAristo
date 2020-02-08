<?php

/**
 * Clase reservation
 * Contiene los datos generales de una reserva
 */

class Reservation extends Database{
    protected $id;
    protected $startDate;
    protected $finishDate;
    protected $roomsQuantity;
    protected $titular;

    /**
    * Constructor que recibe por parámetro un valor numérico id y lo asigna al id del cliente
    */
    public function setId($id){
        $this->id = $id;
        $query = $this->connect()->prepare('SELECT DISTINCT date_format(r.fecha_ingreso,"%X-%m-%d") fecha_ingreso, 
                date_format(r.fecha_salida,"%X-%m-%d") fecha_salida, 
                COUNT(rh.id_registro_habitacion) cantidad_habitaciones,
                r.id_titular, r.id_empresa
                FROM reservas r 
                INNER JOIN registros_habitacion rh ON rh.id_reserva=r.id_reserva
                WHERE r.id_reserva=:id
                GROUP BY fecha_ingreso');

        $query->execute([':id'=>$id]);

        foreach ($query as $current) {
            $this->startDate= $current['fecha_ingreso'];
            $this->finishDate= $current['fecha_salida'];
            $this->roomsQuantity= $current['cantidad_habitaciones'];
            $t=new Holder();

            if($current['id_titular']!=""){
                $t->setId($current['id_titular'],'T');
            }else{
                $t->setId($current['id_empresa'],'E');
            }

            $this->titular=$t;
        }
    }

    public function getStartDate(){
        return $this->startDate;
    }

    public function getFinishDate(){
        return $this->finishDate;
    }
    
    public function getRoomsQuantity(){
        return $this->roomsQuantity;
    }

    public function getTitular(){
        return $this->titular;
    }
}

?>