<?php
    /**
    * Archivo que contiene la información pertinente a la edición de los clientes almacenados en la base de datos
    * @package   clientes.editar
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación de las clases requeridas para el buen funcionamiento de la aplicación
    */
    require_once '../../includes/classes.php';
    $consult=new Consult();
    $userSession = new UserSession();
    $user = new User();
    if(isset($_SESSION['user'])){
        $user->updateDBUser($userSession->getSession());
    }else{
        header('location: /login');
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $p = new Person();
        $p->setId($id);        
    }
?>


<!DOCTYPE html>
<html>
    <!--Importación de librerias css y javascript -->
    <head>
        <title>Clientes | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
    </head>
    
    <!--Construcción de la vista-->
    <body>
        <?php 
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "consultar"
            */
            setCurrentPage("consultar");
        </script>
        
        <!--El bloque de información personal presenta bloques con los datos correspondientes al cliente que se desea editar -->
        <div id="informacion-personal-1" class="marco responsive-page">
            <div class="row-block">
                <div class="input-block">
                    <label>Tipo de documento</label>
                    <br>
                    <select class="col-12" id="doc-type-1">
                        <?php
                        $array = [
                            "CC" => "Cédula de ciudadanía",
                            "RC" => "Registro civil",
                            "TI" => "Tarjeta de identidad",        
                            "CE" => "Cédula de extranjería"];
                        echo '<option value="'.$p->getTypeDocument().'" selected>'.$array[$p->getTypeDocument()].'</option>';
                        printOptions($array[$p->getTypeDocument()], $array);
                                    
                        function printOptions($value, $array){
                            while(list($key, $val)= each($array)){
                                if($value!= $val){
                                    echo '<option value="'.$key.'">'.$val.'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <div class="input-block">
                    <label>Numero de documento</label><br>     
                    <input id="doc-num-1" class="col-12" type="text" placeholder="Número de documento" pattern="[0-9]{1,15}" value="<?php echo  $p->getNumberDocument(); ?>"</input>
                </div>

                <div class="input-block">
                    <label>Lugar de expedición</label>
                    <select id="nac-1" class="col-12">
                        <?php 
                            echo '<option value="'.$p->getPlaceExpedition().'" selected>'.$p->getPlaceExpedition().'</option>';
                        ?>
                    </select>
                </div>
            </div>
                
            <div class="row-block">
                <div class="input-block">
                    <label>Nombres</label><br>
                    <input id="first-1" class="col-12" type="text" placeholder="Nombres" required value="<?php echo $p->getName(); ?>"</input>
                </div>

                <div class="input-block">
                    <label>Apellidos</label><br>
                    <input id="last-1" class="col-12" type="text" placeholder="Apellidos" required value="<?php echo $p->getLastName(); ?>"</input>
                </div>

                <div class="input-block">
                    <label>Telefono</label> <br>
                    <input id="phone-1" class="col-12" type="tel" placeholder="Telefono" pattern="[0-9]{1,15}" required value="<?php echo $p->getPhone(); ?>"</input>
                </div>
                            
                <div class="input-block">
                    <label>Correo</label><br>
                    <input id="email-1" class="col-12" type="email" placeholder="Correo electrónico" value="<?php echo $p->getEmail(); ?>"</input>
                </div>            
            </div>
                        
            <div class="row-block">
                <div class="input-block">
                    <label>Genero</label><br>
                    <select id="gender-1" class="col-12">
                        <?php
                            $array = [
                                "M" => "Hombre",
                                "F" => "Mujer"];
                            echo '<option value="'.$p->getGender().'" selected>'.$array[$p->getGender()].'</option>';
                            printOptions($array[$p->getGender()], $array);
                        ?>
                    </select>
                </div>

                <div class="input-block">
                    <label>Fecha de nacimiento</label><br>
                    <input id="birth-1" class="col-12" type="date" value="<?php echo $p->getBirthDate(); ?>"</input>
                </div>
                        
                <div class="input-block">
                    <label>Tipo de sangre</label><br>
                    <select id="blood-1" class="col-12">
                        <?php
                            $typeBlood = strlen($p->getTypeRH()) > 2 ? substr($p->getTypeRH(), 0, 2):substr($p->getTypeRH(), 0, 1);
                            $array = [
                                "O" => "O",
                                "A" => "A",
                                "B" => "B",
                                "AB" => "AB",];
                            echo '<option value="'.$typeBlood.'" selected>'.$array[$typeBlood].'</option>';
                            printOptions($array[$typeBlood], $array);
                        ?>
                    </select>
                </div>

                <div class="input-block">
                    <label>RH</label><br>
                    <select id="rh-1" class="col-12">
                        <?php 
                            $rh = substr($p->getTypeRH(), -1);
                            $array = [
                                "+" => "+ (Positivo)",
                                "-" => "- (Negativo)"];
                            echo '<option value="'.$rh.'" selected>'.$array[$rh].'</option>';
                            printOptions($array[$rh], $array);
                        ?>
                    </select>
                </div>
            
            </div>
                        
            <div class="row-block">
                <div class="input-block">
                    <label>Profesión</label>
                    <br>
                    <select id="profession-1" class="adding-select">
                        <option value="NULL">Ninguna</option>
                        <?php 
                            echo '<option value="'.$p->getProfession().'" selected>'.$p->getProfession().'</option>';
                            $consult->getRemainingProfession($p->getProfession());
                        ?>
                    </select>
                    <button>+</button>
                </div>

                <div class="input-block">
                    <label>Nacionalidad</label>
                    <br>
                    <select id="nac-1" class="col-12">
                        <?php 
                            echo '<option value="'.$p->getPlaceBirth().'" selected>'.$p->getPlaceBirth().'</option>';
                            $consult->getRemainingNac($p->getPlaceBirth())
                        ?>
                    </select>
                </div>            
            </div>
        </div>
        
        <!-- Presenta el botón correspondiente a la actualización de los datos del cliente -->
        <a id="button-book" class="col-12">Actualizar Datos</a>

        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php"; 
        ?>
    </body>
</html>
