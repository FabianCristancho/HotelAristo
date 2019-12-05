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
							<label>Numero de documento</label>
							<br>
                            
							<input id="doc-num-1" class="col-12" type="text" placeholder="Número de documento" pattern="[0-9]{1,15}" value="<?php echo $p->getNumberDocument(); ?>"</input>
						</div>

						<div class="input-block">
							<label>Fecha de expedición</label>
							<br>
							<input id="doc-date-1" class="col-12" type="date">
						</div>
            </div>
                        <div class="row-block">
						<div class="input-block">
							<label>Nombres</label>
							<br>
							<input id="first-1" class="col-12" type="text" placeholder="Nombres" required>
						</div>

						<div class="input-block">
							<label>Apellidos</label>
							<br>
							<input id="last-1" class="col-12" type="text" placeholder="Apellidos" value="Cristacnh" required>
						</div>

						<div class="input-block">
							<label>Telefono</label>
							<br>
							<input id="phone-1" class="col-12" type="tel" placeholder="Telefono" pattern="[0-9]{1,15}" required>
						</div>
                            

						<div class="input-block">
							<label>Correo</label>
							<br>
							<input id="email-1" class="col-12" type="email" placeholder="Correo electrónico">
						</div>
                            
                            </div>
                        
            <div class="row-block">
                <div class="input-block">
							<label>Genero</label>
							<br>
							<select id="gender-1" class="col-12">
								<option value="M">Hombre</option>
								<option value="F">Mujer</option>
							</select>
						</div>

						<div class="input-block">
							<label>Fecha de nacimiento</label>
							<br>
							<input id="birth-1" class="col-12" type="date">
						</div>
                        
                        <div class="input-block">
							<label>Tipo de sangre</label>
							<br>
							<select id="blood-1" class="col-12">
								<option value="O">O</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="AB">AB</option>
							</select>
						</div>

						<div class="input-block">
							<label>RH</label>
							<br>
							<select id="rh-1" class="col-12">
								<option value="+">+ (Positivo)</option>
								<option value="-">- (Negativo)</option>
							</select>
						</div>
            
            </div>
                        
                    <div class="row-block">
						<div class="input-block">
							<label>Profesión</label>
							<br>
							<select id="profession-1" class="adding-select">
								<option value="NULL">Ninguna</option>
								<?php $consult->getList('profession',''); ?>
							</select>
							<button>+</button>
						</div>

						<div class="input-block">
							<label>Nacionalidad</label>
							<br>
							<select id="nac-1" class="col-12">
								<?php $consult->getList('country',''); ?>
							</select>
						</div>
                        
					</div>
				</div>
        
        <?php
            echo "Cliente con id".$id." se llama ".$p->getName()." ".$p->getLastName()." y nació en ".$p->getPlaceBirth(); 
        echo $p->getNumberDocument();
        ?>
        

        <div id="aux-footer" class="col-12"></div>
        <footer class="col-12">
            Hotel Aristo 2019
        </footer>
    </body>
</html>
