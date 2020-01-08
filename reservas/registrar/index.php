<?php
    /**
    * Archivo que contiene un formulario para el registro de una nueva reserva
    * @package   reservas.registrar
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
    	header('location: ../login');
    }
?>

<!DOCTYPE html>
<html>
    <!--Importación de librerias css y javascript -->
    <head>
		<title>Nueva reserva | Hotel Aristo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/res/img/famicon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/main-800.css">
		<link rel="stylesheet" type="text/css" href="/css/main-1024.css">
		<link rel="stylesheet" type="text/css" href="/css/main-1366.css">
		<link rel="stylesheet" type="text/css" href="/css/alerts.css">
		<link rel="stylesheet" type="text/css" href="/css/modal.css">
		<script type="text/javascript" src="/js/moment.js"></script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/dynamic.js"></script>
		<script type="text/javascript" src="/js/hotel-db.js"></script>
	</head>

	<!--Construcción de la vista-->

	<body onload ="getDate('start-date',0); getDate('finish-date',1);">
        <!--
            Menu de la aplicación web del hotel Aristo
            la clase main-menu-item pertenece a los botones del menú
        -->
        
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
            setCurrentPage("registrar");
        </script>
        
		<!--El bloque de contenido es la vista principal de cada pagina
			puede contener varias clases marco, que distribuyen la informacion.
			Si existe un formulario cada dato para introducir es colocado en una clase input-block
			que contiene una etiqueta y una entrada de informacion
        -->
        <div id="content" class="col-12">
            <div style="float: left;" class="marco responsive-page">
                <div class="col-10">
                    <div class="input-block">
                        <label>Fecha de llegada</label>
                        <br>
                        <input id="start-date" class="col-12" type="date">
                    </div>

                    <div class="input-block">
                        <label>Fecha de salida</label>
                        <br>
                        <input id="finish-date" class="col-12" type="date" onchange="getDays();">
                    </div>

                    <div class="input-block">
                        <label value="1">Cantidad de noches</label>
                        <br>
                        <input id="count-nights" type="number" min="1" value="1" onchange="getDate('finish-date', this.value);">
                    </div>
                    
                </div>
                
                <div id="name-employee" class="input-block">
                    <label>Registrado por:</label>
                    <br>
                    <input id="user-name" class="col-12" type="input" value="<?php echo $user->getFullName(); ?>" disabled>
                </div>
                
            </div>

            <div class="marco responsive-page">
                <label>Habitación</label><br>
                
                <div class="input-block">
                    <label >Tipo de habitacion</label>
                    <br>
                    <select id="room-type" class="col-12" onchange="updateRooms();">
                        <option value="J" selected>JOLIOT</option>
                        <option value="H">HAWKING</option>
                        <option value="L">LISPECTOR</option>
                        <option value="M">MAKKAH</option>
                    </select>
                </div>

                <div class="input-block">
                    <label>Número de habitación</label>
                    <br>
                    <select id="room-select" class="col-12" >
                        <?php $consult->getList('roomType','J'); ?>
                    </select>
                </div>

                <div class="input-block">
                    <label>Numero de huespedes</label>
                    <br>
                    <select id="cantidad-huespedes" onchange ="updateGuest();">
                        <option value="1">1 (Sencilla)</option>
                        <option value="2">2 (Pareja)</option>
                        <option value="2">2 (Doble)</option>
                        <option value="3">3 (Triple)</option>
                        <option value="4">3 (Triple + Sofacama)</option>
                    </select>
                </div>

                <div class="input-block">
                    <label>Tarifa de habitación</label>
                    <br>
                    <input id="room-rate" class="col-12" type="text" placeholder="Tarifa de habitación" pattern="[0-9]{1,15}">
                </div>

                <div class="input-block">
                    <label>Adicional</label>
                    <br>
                    <select id="cantidad-huespedes" onchange ="updateGuest();">
                        <option value="0">Ninguno</option>
                    </select>
                </div>
                
            </div>
            
            <div id="informacion-personal-1" class="marco responsive-page">
                <label>Información personal (1)</label> 
                <button onclick="showAllInputs(1);">Check in</button>
                <br>
                <div id="input-identity-1" class="row-block">
                    
                    <div class="input-block">
                        <label>Tipo de documento</label>
                        <br>
                        <select class="col-12" id="doc-type-1">
                            <option value="CC">Cédula de ciudadania</option>
                            <option value="RC">Registro civil</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CE">Cedula de extranjeria</option>
                        </select>
                    </div>

                    <div class="input-block">
                        <label>Numero de documento</label>
                        <br>
                        <input id="doc-num-1" class="col-12" type="text" placeholder="Número de documento" pattern="[0-9]{1,15}">
                    </div>

                    <div class="input-block">
                        <label>Fecha de expedición</label>
                        <br>
                        <input id="doc-date-1" class="col-12" type="date">
                    </div>
						
                    <div class="input-block">
                        <label>Pais</label>
                        <br>
                        <select id="nac-1" class="col-12">
                            <?php $consult->getList('country',''); ?>
                        </select>
                    </div>

                    <div class="input-block">
                        <label>Ciudad</label>
                        <br>
                        <select id="nac-1" class="col-12">
                            <?php $consult->getList('city',''); ?>
                        </select>
                    </div>
                </div>

                <div class="input-block">
                    <label>Empresa</label>
                    <br>
                    <select id="enterprise-1" class="adding-select">
                        <option value="NULL">NINGUNA</option>
                        <?php $consult->getList('enterprise',''); ?>
                    </select>
                    <button onclick="showModal('add-bizz');">+</button>
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
                        <input id="last-1" class="col-12" type="text" placeholder="Apellidos" required>
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

                <div id="input-more-1" class="row-block">
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
            
            <div id="informacion-personal-2" class="marco responsive-page">
                <label>Información personal (2)</label> 
                <button onclick="showAllInputs(2);">Check in</button>
                <br>
                <div id="input-identity-2" class="row-block">
                    <div class="input-block">
                        <label>Tipo de documento</label>
                        <br>
                        <select id="doc-type-2" class="col-12">
                            <option value="CC">Cédula de ciudadania</option>
                            <option value="RC">Registro civil</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CE">Cedula de extranjeria</option>
                        </select>
                    </div>

                    <div class="input-block">
                        <label>Numero de documento</label>
                        <br>
                        <input id="doc-num-2" class="col-12" type="text" placeholder="Número de documento" pattern="[0-9]{1,15}">
                    </div>

                    <div class="input-block">
                        <label>Fecha de expedición</label>
                        <br>
                        <input id="doc-date-2" class="col-12" type="date">
                    </div>
                </div>

                <div class="input-block">
                    <label>Empresa</label>
                    <br>
                    <select id="enterprise-2" >
                        <option>NINGUNA</option>
                        <?php $consult->getList('enterprise',''); ?>
                    </select>
                    <button onclick="showModal('add-bizz')">+</button>
                </div>

                <div class="row-block">
                    <div class="input-block">
                        <label>Nombres</label>
                        <br>
                        <input id="first-2" class="col-12" type="text" placeholder="Nombres" required>
                    </div>

                    <div class="input-block">
                        <label>Apellidos</label>
                        <br>
                        <input id="last-2" class="col-12" type="text" placeholder="Apellidos" required>
                    </div>

                    <div class="input-block">
                        <label>Telefono</label>
                        <br>
                        <input id="phone-2" class="col-12" type="tel" placeholder="Telefono" pattern="[0-9]{1,15}" required>
                    </div>

                    <div class="input-block">
                        <label>Correo</label>
                        <br>
                        <input id="email-2" class="col-12" type="email" placeholder="Correo electrónico">
                    </div>
                </div>

                <div id="input-more-2" class="row-block">
                    <div class="input-block">
                        <label>Genero</label>
                        <br>
                        <select id="gender-2" class="col-12">
                            <option value="M">Hombre</option>
                            <option value="F">Mujer</option>
                        </select>
                    </div>

                    <div class="input-block">
                        <label>Fecha de nacimiento</label>
                        <br>
                        <input id="birth-2" class="col-12" type="date">
                    </div>

                    <div class="input-block">
                        <label>Tipo de sangre</label>
                        <br>
                        <select id="blood-2" class="col-12">
                            <option value="O">O</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                        </select>
                    </div>

                    <div class="input-block">
                        <label>RH</label>
                        <br>
                        <select id="rh-2" class="col-12">
                            <option value="+">+ (Positivo)</option>
                            <option value="-">- (Negativo)</option>
                        </select>
                    </div>

                    <div class="input-block">
                        <label>Profesión</label>
                        <br>
                        <select id="profession-2" >
                            <option value="NULL">Ninguna</option>
                            <?php $consult->getList('profession',''); ?>
                        </select>
                        <button>+</button>
                    </div>

                    <div class="input-block">
                        <label>Nacionalidad</label>
                        <br>
                        <select id="nac-2" class="col-12">
                            <?php $consult->getList('country',''); ?>
                        </select>
                    </div>
                </div>
            </div>
            <a onclick="sendReservation();" id="button-book" class="col-10">Reservar</a>
        </div>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php"; 
        ?>

        <!--Las clases modal se pondrán por encima del contenido principal,
				funcionan para agregar información adicional, ver detalles o una verificación-->
        <div id="add-bizz" class="modal" onclick="touchOutside(this);">
            <div class="modal-content">
            
                <div class="modal-header">
                    <span onclick="hideModal('add-bizz');" class="close">&times;</span>
                    <h2>Agregar empresa</h2>
                </div>
                
                <div class="modal-body">
                    <div class="marco full-page">
                        <label>Información de empresa</label>
                        <br>
                        <div id="nit-block" class="input-block">
                            <label>NIT</label>
                            <br>
                            <input id="ent-nit" class="col-12 data-group" type="text" placeholder="NIT" required>
                        </div>
                        <div class="input-block">
                            <label>Nombre de la empresa</label>
                            <br>
                            <input id="ent-name" type="text" placeholder="Nombre de la empresa" required>
                        </div>
                        <div class="input-block">
                            <label>Telefono</label>
                            <br>
                            <input id="ent-phone" type="text" placeholder="Telefono">
                        </div>
                        <div class="input-block">
                            <label>Correo</label>
                            <br>
                            <input id="ent-email" type="text" placeholder="Correo">
                        </div>
                        <div class="input-block">
                            <label>Retefuente 3,5%</label>
                            <br>
                            <input id="ent-ret" type="radio" name="retefuente" value="Si"> Si
                            <input type="radio" name="retefuente" checked=> No
                        </div>
                        <div class="input-block">
                            <label>Otro impuesto</label>
                            <br>
                            <select id="ent-tax" class="col-12">
                                <option value="NULL">Ninguno</option>
                                <?php $consult->getList('tax',''); ?>
                            </select>
                        </div>
                    </div>
                    <a onclick="sendEnterprise();" id="button-book-bizz">Registrar</a>
                </div>
            </div>
        </div>
        
        <!--El bloque de alertas contiene cuatro tipos de alertas para darle al usuario
        visibilidad de los procesos. Se definieron: Peligro, Informacion, Precausion y Exito-->
        <div id="alerts">
            <div id="alert-d" class="alert danger">
                <span onclick="hideAlert('alert-d');" class="closebtn">&times;</span>  
                <strong>¡Peligro!</strong> 
                <p></p>
            </div>

            <div id="alert-s" class="alert success">
                <span onclick="hideAlert('alert-s');" class="closebtn">&times;</span>  
                <strong>¡Procedimiento exitoso!</strong> 
                <p></p>
            </div>

            <div id="alert-i" class="alert info">
                <span onclick="hideAlert('alert-i');" class="closebtn">&times;</span>  
                <strong>Información!</strong> 
                <p></p>
            </div>
            
            <div id="alert-w" class="alert warning">
                <span onclick="hideAlert('alert-w');" class="closebtn">&times;</span>  
                <strong>¡Precaución!</strong> 
                <p><p>
            </div>
        </div>
    </body>
</html>