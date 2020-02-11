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
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
        <script type="text/javascript" src="/js/jquery.js"></script>
    </head>
    
    <!--Construcción de la vista-->
    <body>
        <?php 
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>
        
        <!--El bloque de información personal presenta bloques con los datos correspondientes al cliente que se desea editar -->
       <div class="content col-12 padd">
            <div class="wrap-main wrap-main-big col-10 wrap-10 padd">
                <div class="content-header">
                    <h2 class="title-form">EDITAR CLIENTE</h2>
                </div>

                <div class="row-simple">
                    <div class="col-12 padd">
                        <div class="card card-client col-12">
                            <div class="card-header">
                                <i class="fa fa-user"></i>
                                <strong class="card-title">Información personal</strong>
                            </div>

                            <div class="hideable card-search">
                                <div class="row">
                                    <div class="form-group in-row">
                                        <label class="form-control-label">Busqueda por número de documento</label>
                                        <div class="input-group">
                                            <div class="input-group-icon">
                                                <i class="fa fa-search"></i>
                                            </div>
                                            <input class="form-control" type="text" placeholder="Documento" maxlength="15" minlength="7" onkeypress="searchEvent(event,this,'person');" onkeydown="$(this).mask('000000000000');">
                                            <button type="button" onclick="searchPerson(this.previousElementSibling);"><i class="fa fa-search"></i></button>
                                        </div>
                                        <small class="form-text text-muted">ej. 102055214</small>
                                    </div>
                                </div>
                            </div>

                            <div class="hideable id-container"></div>

                            <div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group in-row col-6 padd">
                                            <label class="form-control-label">Nombres*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-user-o"></i>
                                                </div>
                                                <input class="form-control" type="text" placeholder="Nombres" onkeyup="this.value=this.value.toUpperCase();" onkeydown="checkInputOnlyLetters(event,this);" maxlength="60" minlength="2" required>
                                            </div>
                                            <small class="form-text text-muted">ej. PEDRO LUIS</small>
                                        </div>

                                        <div class="form-group in-row col-6 padd">
                                            <label class="form-control-label">Apellidos*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-user-o"></i>
                                                </div>
                                                <input class="form-control" type="text" placeholder="Apellidos" onkeyup="this.value=this.value.toUpperCase();" onkeydown="checkInputOnlyLetters(event,this);" minlength="2" maxlength="60" required>
                                            </div>
                                            <small class="form-text text-muted">ej. PEREZ PEREZ</small>
                                        </div>
                                    </div>

                                    <div class="row row-flag" state="hide">
                                        <div class="form-group in-row col-4 padd">
                                            <label class="form-control-label">Tipo de documento*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-id-card"></i>
                                                </div>

                                                <select class="form-control">
                                                    <option value="CC">Cédula de ciudadania</option>
                                                    <option value="RC">Registro civil</option>
                                                    <option value="TI">Tarjeta de identidad</option>
                                                    <option value="CE">Cedula de extranjeria</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group in-row col-5 padd">
                                            <label class="form-control-label">Número de documento*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-id-card"></i>
                                                </div>
                                                 <input class="form-control" type="number" placeholder="Número de documento" minlength="6" maxlength="15">
                                            </div>
                                            <small class="form-text text-muted">ej. 12345678</small>
                                        </div>

                                        <div class="form-group in-row col-3 padd">
                                            <label class="form-control-label">Fecha de expedición*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control" type="date">
                                            </div>
                                            <small class="form-text text-muted">ej. 10/12/2004</small>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group in-row col-7 padd">
                                            <label class="form-control-label">Pais (Expedición)*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>

                                                <select class="form-control" onchange="updateCities(this);">
                                                    <?php $consult->getList('country',''); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group in-row col-5 padd">
                                            <label class="form-control-label">Ciudad (Expedición)*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>

                                                <select class="form-control">
                                                    <?php $consult->getList('city','1'); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group in-row col-4 padd">
                                            <label class="form-control-label">Telefono*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input class="form-control phone-mask" type="text" placeholder="Telefono" maxlength="15" minlength="7" onkeydown="$(this).mask('000 000 0000');" required>
                                            </div>
                                            <small class="form-text text-muted">ej. 3123334466</small>
                                        </div>

                                        <div class="form-group in-row col-8 padd">
                                            <label class="form-control-label">Correo</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                 <input class="form-control" type="email" placeholder="Correo electrónico">
                                            </div>
                                            <small class="form-text text-muted">ej. pedro.lopez@mail.com</small>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group in-row col-3 padd">
                                            <label class="form-control-label">Genero*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-intersex"></i>
                                                </div>

                                                <select class="form-control">
                                                    <option value="M">Hombre</option>
                                                    <option value="F">Mujer</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group in-row col-4 padd">
                                            <label class="form-control-label">Fecha de nacimiento*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control" type="date">
                                            </div>
                                            <small class="form-text text-muted">ej. 22/09/1985</small>
                                        </div>

                                        <div class="form-group in-row col-5 padd">
                                            <label class="form-control-label">Tipo de sangre*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-heartbeat"></i>
                                                </div>

                                                <select class="form-control col-3 padd">
                                                    <option value="O">O</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                </select>

                                                 <select class="form-control col-9 padd">
                                                    <option value="+">+ (Positivo)</option>
                                                    <option value="-">- (Negativo)</option>
                                                </select>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group in-row col-3 padd">
                                            <label class="form-control-label">Profesión</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-bank"></i>
                                                </div>

                                               <select class="form-control">
                                                    <option value="NULL">Ninguna</option>
                                                    <?php $consult->getList('profession',''); ?>
                                                </select>
                                                <button type="button" onclick="showModal('add-prof');" class="btn-circle"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-group in-row col-6 padd">
                                            <label class="form-control-label">Nacionalidad*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>

                                                <select class="form-control">
                                                    <?php $consult->getList('country',''); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <a class="col-12 btn btn-block btn-register">Actualizar datos</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Presenta el botón correspondiente a la actualización de los datos del cliente -->

        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php";
            include "../../objects/alerts.php";
        ?>

        <div style="display: none;">
            <div id="room-group" class="room-group col-12">
                <div class="col-12 padd row-simple">
                    <?php 
                        include "../../objects/input-room.php";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
