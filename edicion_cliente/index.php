<?php
    include_once '../includes/database.php';
    include_once '../includes/consult.php';
    include_once '../includes/person.php'; 
    $consult=new Consult();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $p = new Person();
        $p->setId($id);        
    }
    if($p->getNumberDocument() === NULL){
        header('Location: ../clientes');
    }

        $idPerson = $_POST['id'];
        $typeDoc = $_POST['typeDoc'];
        $numberDoc = $_POST['numberDoc'];
        $placeExp = $_POST['placeExp'];
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $birthDate = $_POST['birthDate'];
        $typeBlood = $_POST['typeBlood'];
        $rh = $_POST['rh'];
        $profession = $_POST['profession'];
        $nationality = $_POST['nationality'];
        
        
        $con=mysqli_connect("localhost","admin","admin","hotelaristo");

        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        mysqli_query($con,"UPDATE personas SET id_persona = $id, id_lugar_expedicion = $consult->genericSelect('lugares', 'id_lugar', 'nombre_lugar', $placeExp), nombres_persona = $name, apellidos_persona = $lastName, tipo_documento = CASE WHEN $typeDoc = 'Cédula de ciudadanía' THEN 'CC' WHEN $typeDoc = 'Cédula de extranjería' THEN 'CE' WHEN $typeDoc = 'Registro civil' THEN 'RC' WHEN $typeDoc = 'Tarjeta de identidad' THEN 'TI' END, numero_documento = $numberDoc, genero_persona = CASE WHEN $gender = 'Mujer' THEN 'M' WHEN $gender = 'Hombre' THEN 'H' END fecha_nacimiento = $birthDate tipo_sangre_rh = $typeBlood$rh, telefono_persona = $phone, correo_persona = $email, id_profesion = $consult->genericSelect('profesiones', 'id_profesion', 'nombre_profesion', $profession)");
        
        $sql = mysqli_query()
    

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Clientes | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/main-800.css">
        <link rel="stylesheet" type="text/css" href="../css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="../css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="../css/alerts.css">
        <script type="text/javascript" src="../js/moment.js"></script>
        <script type="text/javascript" src="../js/dynamic.js"></script>
        <style>
            .row-block{
                padding-bottom: 10px;
            } 
        </style>
    </head>
    
    
    <body>
        <header class="col-12">
            <a href="../inicio">
                <img id="logo-hotel" src="../res/img/logoA.png">
            </a>
            <button onclick="window.location.href = '../inicio';" class="main-menu-item menu-item" >
                <img src="../res/img/home-icon-black.png">
                <p>Inicio</p>
            </button>

            <div class="dropdown menu-item">
                <button onclick="window.location.href = '';"   class="main-menu-item">
                    <img src="../res/img/book-icon-black.png">
                    <p>Registrar</p>
                </button>
                <br>
                <div class="dropdown-content">
                    <a href="../nueva_reserva">Registar reserva</a>
                    <a href="../nueva_empresa">Registrar empresas</a>
                </div>
            </div>

            <div class="dropdown menu-item">
                <button id="current-item" onclick="window.location.href = '';" class="main-menu-item">
                    <img src="../res/img/book-icon-white.png">
                    <p>Consultar</p>
                </button>
                <br>
                <div class="dropdown-content">
                    <a href="../reservas">Consultar reservas</a>
                    <a href="../clientes">Consultar clientes</a>
                    <a href="../empresas">Consultar empresas</a>
                    <a href="../habitaciones">Consultar habitaciones</a>
                </div>
            </div>


            <button onclick="window.location.href = '../control_diario';" class="main-menu-item menu-item">
                <img src="../res/img/control-icon-black.png">
                <p>Control diario</p>
            </button>
            <button onclick="window.location.href = '';" class="main-menu-item menu-item">
                        <img src="../res/img/bill-icon-black.png">
                <p>Facturación</p>
            </button>

            <button onclick="window.location.href = '../includes/logout.php';" class="main-menu-item menu-item">
                <img src="../res/img/logout-icon-black.png">
                <p>Cerrar sesión</p>
            </button>
        </header>
        
        <div id="informacion-personal-1" class="marco responsive-page">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row-block">
                    <div class="input-block">
                        <label>Tipo de documento</label>
                        <br>
                        <select class="col-12" id="doc-type-1" name="typeDoc">
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
                        <input id="doc-num-1" class="col-12" type="text" placeholder="Número de documento" name="numberDoc" pattern="[0-9]{1,15}" value="<?php echo  $p->getNumberDocument(); ?>"</input>
                    </div>

                    <div class="input-block">
                        <label>Lugar de expedición</label>
                        <select id="nac-1" class="col-12" name="placeExp">
                            <?php 
                                echo '<option value="'.$p->getPlaceExpedition().'" selected>'.$p->getPlaceExpedition().'</option>';
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row-block">
                    <div class="input-block">
                        <label>Nombres</label><br>
                        <input id="first-1" class="col-12" type="text" placeholder="Nombres" name="name" required value="<?php echo $p->getName(); ?>"</input>
                    </div>

                    <div class="input-block">
                        <label>Apellidos</label><br>
                        <input id="last-1" class="col-12" type="text" placeholder="Apellidos" name="lastName" required value="<?php echo $p->getLastName(); ?>"</input>
                    </div>

                    <div class="input-block">
                        <label>Telefono</label> <br>
                        <input id="phone-1" class="col-12" type="tel" placeholder="Telefono" name="phone" pattern="[0-9]{1,15}" required value="<?php echo $p->getPhone(); ?>"</input>
                    </div>

                    <div class="input-block">
                        <label>Correo</label><br>
                        <input id="email-1" class="col-12" type="email" placeholder="Correo electrónico" name="email" value="<?php echo $p->getEmail(); ?>"</input>
                    </div>            
                </div>

                <div class="row-block">
                    <div class="input-block">
                        <label>Genero</label><br>
                        <select id="gender-1" class="col-12" name="gender">
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
                        <input id="birth-1" class="col-12" type="date" name="birthDate" value="<?php echo $p->getBirthDate(); ?>"</input>
                    </div>

                    <div class="input-block">
                        <label>Tipo de sangre</label><br>
                        <select id="blood-1" class="col-12" name="typeBlood">
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
                        <select id="rh-1" class="col-12" name="rh">
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
                        <select id="profession-1" class="adding-select" name="profession">
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
                        <select id="nac-1" class="col-12" name="nationality">
                            <?php 
                                echo '<option value="'.$p->getPlaceBirth().'" selected>'.$p->getPlaceBirth().'</option>';
                                $consult->getRemainingNac($p->getPlaceBirth())
                            ?>
                        </select>
                    </div>            
                </div>
            </form>
        </div>
        <input type="submit", value="Actualizar Datos" id = "button-book">
        
        
        <div id="aux-footer" class="col-12"></div>
        <footer class="col-12">
            Hotel Aristo 2019
        </footer>
    </body>
</html>
