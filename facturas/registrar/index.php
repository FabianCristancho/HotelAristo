<?php
    /**
    * Archivo que contiene la información pertinente a la factura de servicios
    * @package   factura
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación de las clases requeridas para el buen funcionamiento de la aplicación
    */
    require_once '../../includes/classes.php';
    $user = new User();
    $userSession = new UserSession();
    $database = new Database();
    $consult = new Consult();
    
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
        <title>Factura | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/modal.css">
        <link rel="stylesheet" type="text/css" href="/css/reporte_factura.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/factura.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" type="text/css" href="/css/table.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="bill-register.js"></script>
        <!--<script>
            function changeSelect(){
                var select = document.getElementById("selectType"); 
                var index = select.options[select.selectedIndex].index; 
                var serieBill = document.getElementById("serieBill");
                var serieOrder = document.getElementById("serieOrder");
                if(index==0){
                    serieOrder.style.display = "none";
                    serieBill.style.display = "inline";
                }else{
                    serieBill.style.display = "none";
                    serieOrder.style.display = "inline";
                }
            }
        </script>-->
    </head>

    <body>
        <?php 
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>

        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "facturas"
            */
            setCurrentPage("facturas");
        </script>

        <!--Bloque encargado de mostrar los detalles correspondientes a la factura de una reserva-->
        <div class="col-11 content">
            <div class="col-11 wrap-11 marco wrap-vertical padd">
                <div class="content-header col-12">
                    <div class="row col-12">
                        <h2 class="title-form col-12">FACTURACIÓN</h2>
                    </div>
                </div>
                
                <div class="series">
                    <select name="typeBill" id="selectType" onchange="return changeSelect();">
                        <option value="Factura de Venta" selected>Factura de Venta</option>
                        <option value="Orden de Servicio">Orden de Servicio</option>
                    </select>
                    <p>No&nbsp;&nbsp; <strong id="serieBill"><?php echo $consult->getNextSerieBill(); ?></strong><strong id="serieOrder" hidden><?php echo $consult->getNextSerieOrder(); ?></strong></p>
                </div>
                
                <div class="card-search">
                    <div class="infos">
                        <div class="row">
                            <div class="form-group in-row" hidden>
                                <label class="form-control-label"><b>Tipo de identificación del titular</b></label>
                                <div class="input-group">
                                    <label>Cédula&nbsp;&nbsp;</label>
                                    <input type="radio" name="typeId" value="Documento" checked>
                                    &nbsp;&nbsp;&nbsp;
                                    <label>NIT&nbsp;&nbsp;</label>
                                    <input type="radio" name="typeId">
                                </div>
                            </div>
                            <div class="form-group in-row">
                                <label class="form-control-label"><b>Número de Identificación</b></label>
                                <div class="input-group">
                                    <div class="input-group-icon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input class="form-control" type="number" placeholder="Documento" maxlength="15" minlength="7" onkeypress="return validateNumericValue(event);">
                                    <button type="button" onclick="searchTitular(this.previousElementSibling);"><i class="fa fa-search"></i></button>
                                </div>
                                <small class="form-text text-muted">ej. 102055214</small>
                            </div>
                        </div>
                        <p><b>Nombre: </b><label></label></p>
                        <p><b>Empresa: </b> <label></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <b>Teléfono: </b><label></label></p>
                        <p><b>Número de Documento: </b><label></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <b>Habitación (es):</b> <label></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <b>Fecha Entrada: </b><label></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <b>Fecha Salida: </b><label></label></p>
                        <p id="key" class="hideable"></p>
                    </div>
                    
                    <div class="col-12">
                        <table>
                            <tr>
                                <th class="long_cols">Descripción</th>
                                <th>Cantidad</th>
                                <th>Valor Unitario ($)</th>
                                <th class="long_values">Valor Total ($)</th>
                            </tr>
                            <tbody id="myTable"></tbody>
                        </table>
                    </div>


                    <div class="table_totals col-12">
                        <table>
                            <tr class="long_letters">
                                <td class="long_totals"></td>
                                <td><b>Total $</b></td>
                                <td class="long_values" id="valueTotal">$</td>
                            </tr>
                        </table>
                    </div>
                </div>

                

                <div class="option_bill">
                    <form action="">
                        <button formtarget="_blank" id="generateBill" type="submit" class="button-add-book col-2">
                            <span>GENERAR FACTURA</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        
        
                   <!-- <form target="_blank" action="" method="POST">
                        <input type="submit" value="Generar factura" style="font-size:18px;" name="crear"/>
                    </form> -->

        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php"; 
        ?>
    </body>
</html>