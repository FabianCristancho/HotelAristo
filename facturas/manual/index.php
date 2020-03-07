<?php 
    require_once '../../includes/classes.php';
    $consult=new Consult();
?>


<!DOCTYPE html>
<html>

<head>
	<title>Factura | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/img/famicon.png" />
	<link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/modal.css">
    <link rel="stylesheet" type="text/css" href="/css/reporte_factura.css">
    <link rel="stylesheet" type="text/css" href="/css/factura2.css">
	<link rel="stylesheet" type="text/css" href="/css/alerts.css">
	<script type="text/javascript" src="/js/moment.js"></script>
	<script type="text/javascript" src="/js/dynamic.js"></script>
    <script type="text/javascript">
		function calcValues()
		{
            document.getElementById("vTotal1").value=((document.getElementById("cant1").value)*(document.getElementById("unit1").value));
            document.getElementById("vTotal2").value=((document.getElementById("cant2").value)*(document.getElementById("unit2").value));
            document.getElementById("vTotal3").value=((document.getElementById("cant3").value)*(document.getElementById("unit3").value));
            document.getElementById("valueTotal").value=(parseInt(document.getElementById("vTotal1").value)+parseInt(document.getElementById("vTotal2").value)+parseInt(document.getElementById("vTotal3").value));
		}
	</script>
</head>

<body onload ="getDate('control-date',0);">
    
    <div class="border">
            <div class="borderUp"></div>
            <div class="borderDown"></div>
    </div>
    
    <div class="marco nearly-page">
        <h1>FACTURACIÓN - HOTEL ARISTO</h1>
        <form action="/reportes/facturas/manualBill.php" method="POST">
            <div class="series">
            <select name="typeBill">
                <option value="Factura de Venta" selected>Factura de Venta</option>
                <option value="Orden de Servicio">Orden de Servicio</option>
                </select>
                <p><b>No</b>&nbsp;&nbsp;&nbsp;&nbsp; 
                    <label class="code_bill" name="idBill"><?php echo $consult->getNextSerieBill();?></label>
                </p>
            </div>
            <div class="infos">
                <b>Nombre:</b>
                <input type="text" name="name">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>Empresa:</b>
               <input type="text" name="enterprise"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                
                </br></br>
                <input type="radio" name="id" checked value="NIT"><b>NIT</b></input>
                <input type="radio" name="id" value="C.C."><b>C.C.</b></input>
                <input type="text" name="typeId">  
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>Habitación (es): </b>
                <input type="text" name="rooms">
                <!-- <select name="room" class="lista-habitaciones">
                    <option value="201">201</option>
                    <option value="202">202</option>
                    <option value="301">301</option>
                    <option value="302">302</option>
                    <option value="303">303</option>
                    <option value="304">304</option>
                    <option value="401">401</option>
                    <option value="402">402</option>
                    <option value="403">403</option>
                    <option value="404">404</option>
                    <option value="501">501</option>
                    <option value="502">502</option>
                    <option value="503">503</option>
                    <option value="504">504</option>
                    <option value="601">601</option>
                    <option value="602">602</option>
                    <option value="603">603</option>
                </select> -->

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Check in: 
                    </b><input type="date" name="dateGetIn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </br></br>
                    <b>Check out: </b>
                    <input type="date" value="<?php echo date("Y-m-d");?>" name="dateGetOut">
            </div>

            <div class="tables">
                <table id="tableAlign">    
                    <tr>
                        <th class="long_cols">Descripción</th>
                        <th>Cantidad</th>
                        <th>Valor Unitario ($)</th>
                        <th class="long_values">Valor Total ($)</th>
                    </tr>
                    <tr>
                        <td name="desc1"><input type="text" class="desc" name="desc1"></td>
                        <td><input type="number" min="0" max="100" value="1" name="cant1" id="cant1" onkeyup="calcValues()" onchange="calcValues()"></td>
                        <td><input type="text" class="data" name="unit1" id="unit1" onkeyup="calcValues()"></td>
                        <td><input type="text" class="data" name="vTotal1" id="vTotal1" onkeyup="calcValues()" readonly></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="desc" name="desc2"></td>
                        <td><input type="number" min="0" max="100" name="cant2" id="cant2" onkeyup="calcValues()" onchange="calcValues()"></td>
                        <td><input type="text" class="data" name="unit2" id="unit2" onkeyup="calcValues()"></td>
                        <td><input type="text" class="data" name="vTotal2" id="vTotal2" onkeyup="calcValues()" readonly></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="desc" name="desc3"></td>
                        <td><input type="number" min="0" max="100" name="cant3" id="cant3" onkeyup="calcValues()" onchange="calcValues()"></td>
                        <td><input type="text" class="data" name="unit3" id="unit3" onkeyup="calcValues()"></td>
                        <td><input type="text" class="data" name="vTotal3" id="vTotal3" onkeyup="calcValues()" readonly></td>
                    </tr>
                    
                </table>
            </div>

            <div class="table_totals">
                <table>
                    <tr class="long_letters">
                        <td class="long_totals"></td>
                        <td><b>Total ($)</b></td>
                        <td class="long_values"><input type="text" class="vTotal" id="valueTotal" name="valueTotal" readonly></td>
                    </tr>
                </table>
            </div>
            <b>Responsable: </b>
            <input type="text" class="resp" name="resp">
            
            <div class="option_bill" onclick="resultado();">
                <input class="but" type="submit" value="Imprimir factura" name="crear"/> 
            </div>
        </form>
    </div>
    
    
	<?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php"; 
        ?>

</body>
</html>