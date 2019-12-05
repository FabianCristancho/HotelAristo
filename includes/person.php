<?php
/**
 * Clase person
 * Contiene los datos generales de una persona
 */

class Person extends Database{
    private $id;
    private $nombre;
    private $apellido;
    private $tipoDocumento;
    private $numeroDocumento;
    private $lugarNacimiento;
    private $lugarExpedicionDocumento;
    private $genero;
    private $fechaNacimiento;
    private $tipoSangre;
    private $telefono;
    private $correo;
    private $profesion;

    
    /**
    * Constructor que recibe por parámetro un valor numérico id y lo asigna al id del cliente
    */
    public function setId($id){
        $this->id = $id;
        $query = $this->connect()->prepare('SELECT nombres_persona, apellidos_persona, tipo_documento, numero_documento, n.nombre_lugar AS nac, e.nombre_lugar AS exp, CASE genero_persona WHEN "M" THEN "MASCULINO" WHEN "F" THEN "FEMENINO" ELSE "OTRO" END genero, fecha_nacimiento, tipo_sangre_rh, telefono_persona, correo_persona, nombre_profesion FROM personas p, lugares n, lugares e, profesiones pr WHERE id_persona = :id AND p.id_lugar_nacimiento=n.id_lugar AND p.id_lugar_expedicion=e.id_lugar AND p.id_profesion=pr.id_profesion');
        
        $query->execute(['id'=>$id]);
        
        foreach ($query as $currentPerson) {
            $this->nombre = $currentPerson['nombres_persona'];
            $this->apellido = $currentPerson['apellidos_persona'];
            $this->tipoDocumento = $currentPerson['tipo_documento'];
            $this->numeroDocumento = $currentPerson['numero_documento'];
            $this->lugarNacimiento = $currentPerson['nac'];
            $this->lugarExpedicionDocumento = $currentPerson['exp'];
            $this->genero = $currentPerson['genero'];
            $this->fechaNacimiento = $currentPerson['fecha_nacimiento'];
            $this->tipoSangre = $currentPerson['tipo_sangre_rh'];
            $this->telefono = $currentPerson['telefono_persona'];
            $this->correo = $currentPerson['correo_persona'];
            $this->profesion = $currentPerson['nombre_profesion'];
        } 
        
    }
    
    
    function getNumDocument(){
        return $this->numeroDocumento;
    }
    
    function getNombre(){
        return $this->nombre;
    }
    
    function getApellido(){
        return $this->apellido;
    }
    
    function getLugarNacimiento(){
        return $this->lugarNacimiento;
    }
    
    function getTipoDocumento(){
        return $this->tipoDocumento;
    }
}

?>