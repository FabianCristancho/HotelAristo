<?php
include 'person.php';
/**
 * Clase user
 * Contiene los datos primitivos de un suario de la aplicacion.
 */

class User extends Person{
    private $username;
    private $role;

    /*
     * Verifica si la combiancion usuario-cantraseña existe en la base de datos.
     */
    public function exists($user, $password){
        $query = $this->connect()->prepare('SELECT id_persona FROM personas WHERE nombre_usuario = :username AND contrasena_usuario = :password');
        $query->execute(['username' => $user, 'password' => $password]);
        
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * Hace la lectura de un usuario en la base de datos y asigna los atributos a la clase actual. 
     */
    public function updateDBUser($username){
        $this->username = $username;
        $query = $this->connect()->prepare('SELECT id_persona, nombres_persona,apellidos_persona, id_cargo FROM personas p WHERE nombre_usuario = :username');
        $query->execute(['username'=>$username]);      
        
        foreach ($query as $currentUser) {
            $this->id = $currentUser['id_persona'];
            $this->name= $currentUser['nombres_persona'];
            $this->lastName= $currentUser['apellidos_persona'];
            $this->role = $currentUser['id_cargo'];
        } 
    }
    
        
    public function getName(){
        return $this->name;
    }
    
    public function getFullname(){
        return $this->name. ' ' .$this->lastName;
    }
    
    public function getRole(){
        return $this->role;
    }
}

class UserSession{

    public function __construct(){
        session_start();
    }

    public function setSession($user){
        $_SESSION['user'] = $user;
    }

    public function getSession(){
        return $_SESSION['user'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}

?>