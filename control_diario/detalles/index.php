<?php
    /**
    * Archivo que contiene la información pertinente a los detalles de control de una habitación en una fecha especificada
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
?>


<!DOCTYPE html>
<html>
    <!--Importación de librerias css y javascript -->
	<head>
		<title>Control por Habitación | Hotel Aristo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/res/img/famicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
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
	<body onload ="getDate('start-date',0); getDate('finish-date',1);">
	
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
        <div class="content col-12">
             <div class="col-11 wrap-11 wrap-vertical padd">
                <div class="marco col-4 padd">
                    <h3><b>Habitación</b></h3>
                    <div class="form-group">
                        <label class="form-control-label"><b>Número de habitación</b></label>
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fa fa-bed"></i>
                            </div>
                            <select  class="form-control">
                                    <option>201</option>
                                    <option>202</option>
                                    <option>301</option>
                                    <option>302</option>
                                    <option>303</option>
                                    <option>304</option>
                                    <option>401</option>
                                    <option>402</option>
                                    <option>403</option>
                                    <option>404</option>
                                    <option>501</option>
                                    <option>502</option>
                                    <option>503</option>
                                    <option>504</option>
                                    <option>601</option>
                                    <option>602</option>
                                    <option>603</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Tipo de Habitación</b></label>
                        <br><br>
                        <label>Lispector</label>
                    </div>

                    <div class="form-group">
                        <label><b>Estado</b></label>
                        <br><br>
                        <label>Ocupada</label>
                    </div>
                    <div class="form-group">
                        <label><b>Saldo Total ($)</b></label>
                        <br><br>
                        <label>320.000</label>
                    </div>
                </div>

                <div class="marco col-8 padd">
                    <div class="scroll-block">
                        <h3><b>Huéspedes</b></h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Número de Documento</th>
                                    <th>Tipo de sangre</th>
                                    <th>Empresa</th>
                                    <th>Nacionalidad</th>
                                    <th>Profesión</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Giacomo Guilizzoni</td>
                                <td>1034543</td>
                                <td>B+</td>
                                <td>Falabella</td>
                                <td>Italia</td>
                                <td>Médico</td>
                                <td>3125435432</td>
                            </tr>
                            <tr>
                                <td>Gugleimo Guilizzoni</td>
                                <td>1035443</td>
                                <td>O+</td>
                                <td>Falabella</td>
                                <td>Italia</td>
                                <td>Contador</td>
                                <td>3143214323</td>
                            </tr>
                            <tr>
                                <td>Martha Guilizzoni</td>
                                <td>1035443</td>
                                <td>B+</td>
                                <td>Falabella</td>
                                <td>Italia</td>
                                <td>Estudiante</td>
                                <td>3103213198</td>
                            </tr>
                        </table>
                        <br>
                    </div>
                        
                    <div class="form-group">
                        <label><b>Conteo días</b></label>
                        <br>
                        <label>1 de 4</label>
                    </div>

                    <div class="form-group">
                        <label><b>Hora Ingreso</b></label>
                        <br>
                        <label>Ocupada</label>
                    </div>
                    
                    <div class="form-group">
                        <label><b>¿Huésped se encuentra en habitación?</b></label>
                        <br>
                        <input type="radio" name="ocupacion" value="Presencia" checked>Sí
                        <input type="radio" name="ocupacion" value="Ausencia">No
                    </div>
                </div>

                
                <div  class="marco col-12 padd">
                    <h3><b>Consumo de Servicios</b></h3>
                    <div class="form-group">
                        <label class="form-control-label"><b>Valor consumo en minibar ($)</b></label>
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input class="form-control col-12" type="text" placeholder="Valor en minibar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><b>Valor consumo en lavandería ($)</b></label>
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input class="form-control col-12" type="text" placeholder="Valor en lavandería">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><b>Valor consumo en restaurante ($)</b></label>
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input class="form-control col-12" type="text" placeholder="Valor en restaurante">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><b>Valor consumo en adicional ($)</b></label>
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input class="form-control col-12" type="text" placeholder="Valor adicional">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><b>Saldo de consumo ($)</b></label>
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input class="form-control col-12" type="text" placeholder="Saldo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><b>Observaciones</b></label>
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                           <textarea id="textarea-com" name="comentarios" rows="3" cols="30" placeholder="Escriba aquí información adicional" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/alerts.php"; 
            include "../../objects/footer.php"; 
        ?>
    </body>
</html>