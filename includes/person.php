<?php

/**
 * Clase person
 * Contiene los datos generales de una persona
 */

class Person extends Database{
    protected $id;
    protected $name;
    protected $lastName;
    protected $typeDocument;
    protected $numberDocument;
    protected $placeBirth;
    protected $placeExpedition;
    protected $gender;
    protected $birthDate;
    protected $typeRH;
    protected $phone;
    protected $email;
    protected $profession;

    /**
    * Constructor que recibe por parámetro un valor numérico id y lo asigna al id del cliente
    */
    public function setId($id){
        $this->id = $id;
        $query = $this->connect()->prepare('SELECT nombres_persona, apellidos_persona, tipo_documento, numero_documento, n.nombre_lugar AS nac, e.nombre_lugar AS exp, CASE genero_persona WHEN "M" THEN "MASCULINO" WHEN "F" THEN "FEMENINO" ELSE "OTRO" END genero, fecha_nacimiento, tipo_sangre_rh, telefono_persona, correo_persona, nombre_profesion FROM personas p, lugares n, lugares e, profesiones pr WHERE id_persona = :id AND p.id_lugar_nacimiento=n.id_lugar AND p.id_lugar_expedicion=e.id_lugar AND p.id_profesion=pr.id_profesion');
        
        $query->execute(['id'=>$id]);
        
        foreach ($query as $currentPerson) {
            $this->name = $currentPerson['nombres_persona'];
            $this->lastName = $currentPerson['apellidos_persona'];
            $this->typeDocument = $currentPerson['tipo_documento'];
            $this->numberDocument = $currentPerson['numero_documento'];
            $this->placeBirth = $currentPerson['nac'];
            $this->placeExpedition = $currentPerson['exp'];
            $this->gender = $currentPerson['genero'];
            $this->birthDate = $currentPerson['fecha_nacimiento'];
            $this->typeRH = $currentPerson['tipo_sangre_rh'];
            $this->phone = $currentPerson['telefono_persona'];
            $this->email = $currentPerson['correo_persona'];
            $this->profession = $currentPerson['nombre_profesion'];
        } 
    }
    
  
    function getId(){
        return $this->id;
    }
    
    function getName(){
        return $this->name;
    }
    
    function getLastName(){
        return $this->lastName;
    }
    
    function getTypeDocument(){
        return $this->typeDocument;
    }
    
    function getNumberDocument(){
        return $this->numberDocument;
    }
    
     function getPlaceBirth(){
        return $this->placeBirth;
    }
    
    function getPlaceExpedition(){
        return $this->placeExpedition;
    }
    
    function getGender(){
        return $this->gender;
    }
    
    function getBirthDate(){
        return $this->birthDate;
    }
    
    function getTypeRH(){
        return $this->typeRH;
    }
    
    function getPhone(){
        return $this->phone;
    }
    
    function getEmail(){
        return $this->email;
    }
    
    function getProfession(){
        return $this->profession;
    }
}

?>