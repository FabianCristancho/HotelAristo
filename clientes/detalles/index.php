<?php
    /**
    * Archivo que contiene la información pertinente a los detalles reserva 
    * @package   control_diario.detalles
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    require_once '../../includes/classes.php';

    $consult=new Consult();
    $user = new User();
    $userSession = new UserSession();
    
    if(isset($_SESSION['user'])){
        $user->updateDBUser($userSession->getSession());
    }else{
        header('location: /login');
    }

    $id="";

    if(isset($_GET['id']))
        $id=$_GET['id'];
    $reservation=new Reservation();
    $reservation->setId($id);
?>


<!DOCTYPE html>
<html>
    <!--Importación de librerias css y javascript -->
    <head>
        <title>Control por habitación | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" type="text/css" href="/css/modal.css">
        <link rel="stylesheet" type="text/css" href="/css/table.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
        <script type="text/javascript" src="/js/jquery.js"></script>
    </head>

    <!--Construcción de la vista-->
    <body onload ="getDays();">
    
        <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "control-diario"
            */
            setCurrentPage("control-diario");
        </script>
        
        <!--El bloque contiene la información correspondiente a los detalles de control de una habitación en una fecha especificada-->
        <div class="content col-12 padd">
            <div class="wrap-main wrap-main-big col-10 wrap-10 padd">
                <div class="content-header">
                    <h2 class="title-form">DETALLES DE LA RESERVA</h2>
                </div>

                <div class="sub-menu col-12 padd">
                    <button id="back-btn" class="btn" style="float: left;" onclick="window.history.back();">Volver</button>
                    <div class="sub-menu-right">
                        <button id="edit-btn" class="btn" onclick="window.location.href='../editar?id='+<?php echo $id;?>">Editar</button>
                        <button id="delete-btn" class="btn btn-red" onclick="showModal('confirm-delete')">Eliminar</button>
                    </div>
                </div>

                <div class="row-simple">
                    <div class="col-12 padd">
                        <div class="card card-client">
                            <div class="card-header">
                                <i class="fa fa-user"></i>
                                <strong class="card-title">Información personal</strong>
                            </div>

                            <div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group in-row col-6 padd">
                                            <label class="form-control-label">Nombres*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-user-o"></i>
                                                </div>
                                                <input class="form-control" type="text" placeholder="Nombres" onkeyup="this.value=this.value.toUpperCase();" onkeydown="checkInputOnlyLetters(event,this);" maxlength="60" minlength="2" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group in-row col-6 padd">
                                            <label class="form-control-label">Apellidos*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-user-o"></i>
                                                </div>
                                                <input class="form-control" type="text" placeholder="Apellidos" onkeyup="this.value=this.value.toUpperCase();" onkeydown="checkInputOnlyLetters(event,this);" minlength="2" maxlength="60"  disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-flag" state="hide">
                                        <div class="form-group in-row col-4 padd">
                                            <label class="form-control-label">Tipo de documento*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-id-card"></i>
                                                </div>

                                                <select class="form-control" disabled>
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
                                                 <input class="form-control" type="number" placeholder="Número de documento" minlength="6" maxlength="15" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group in-row col-3 padd">
                                            <label class="form-control-label">Fecha de expedición*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control" type="date" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group in-row col-7 padd">
                                            <label class="form-control-label">Pais (Expedición)*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>

                                                <select class="form-control" onchange="updateCities(this);"  disabled>
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

                                                <select class="form-control" disabled>
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
                                                <input class="form-control phone-mask" type="text" placeholder="Telefono" maxlength="15" minlength="7" onkeydown="$(this).mask('000 000 0000');" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group in-row col-8 padd">
                                            <label class="form-control-label">Correo</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                 <input class="form-control" type="email" placeholder="Correo electrónico" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="form-group in-row col-3 padd">
                                            <label class="form-control-label">Genero*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-intersex"></i>
                                                </div>

                                                <select class="form-control" disabled>
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
                                                <input class="form-control" type="date" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group in-row col-5 padd">
                                            <label class="form-control-label">Tipo de sangre*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-heartbeat"></i>
                                                </div>

                                                <select class="form-control col-3 padd" disabled>
                                                    <option value="O">O</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                </select>

                                                 <select class="form-control col-9 padd" disabled>
                                                    <option value="+">+ (Positivo)</option>
                                                    <option value="-">- (Negativo)</option>
                                                </select>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group in-row col-4 padd">
                                            <label class="form-control-label">Profesión</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-bank"></i>
                                                </div>

                                               <select class="form-control" disabled>
                                                    <option value="NULL">Ninguna</option>
                                                    <?php $consult->getList('profession',''); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" form-group in-row col-8 padd">
                                            <label class="form-control-label">Nacionalidad*</label>
                                            <div class="input-group">
                                                <div class="input-group-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>

                                                <select class="form-control" disabled>
                                                    <?php $consult->getList('country',''); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="marco col-12">
                        <div class="scroll-block">
                            <table>
                                <tr>
                                    <th>Habitación</th>
                                    <th>Huesped</th>
                                </tr>
                                <?php $consult->getBookingTable($id); ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            function deleteBooking(id){
                $.ajax({
                    type:'post',
                    url:'/includes/update.php',
                    data:'action=deleteBooking&id='+id
                }).then(function(ans){
                    var data=ans.split(";");
                    showAlert(data[0],data[1]);
                    setTimeout(function(){
                        location.href='/reservas';
                    }, 2000);
                });
            }
        </script>
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/alerts.php"; 
            include "../../objects/footer.php"; 
        ?>

        <div id="confirm-delete" class="modal hideable" onclick="touchOutside(this);">
            <div class="modal-content col-3 wrap-3">
                 <div class="modal-header">
                    <span onclick="hideModal('confirm-delete');" class="close">&times;</span>
                    <h2>Confirmar eliminación</h2>
                </div>

                <div class="modal-body">
                    <div>
                        <div class="card-body">
                            <div style="margin-top: 10px;">
                                Por favor, confirme si desea eliminar este cliente.
                                
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-block btn-register" onclick="deleteClient(<?php echo $id;?>);">
                        <i class="fa fa-check"></i>
                        <span>Confirmar</span>
                    </button>
                </div>
            </div>
        </div>
    </body>
</html>