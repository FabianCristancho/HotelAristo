<?php
    require __DIR__.'/vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;

    //Se extrae el archivo que contiene el contenido de la factura
    if(isset($_POST['crear'])){
        ob_start();
        require_once "print_view.php";
        $html = ob_get_clean();
        $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
        $html2pdf->writeHTML($html);
        $html2pdf->output('factura.pdf');
    }
?>

<!DOCTYPE html>
<html>

<head>
	<title>Factura | Hotel Aristo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/img/famicon.png" />
	<link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/modal.css">
    <link rel="stylesheet" type="text/css" href="../css/reporte_factura.css">
    <link rel="stylesheet" type="text/css" href="../css/factura.css">
	<link rel="stylesheet" type="text/css" href="../css/main-800.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1024.css">
    <link rel="stylesheet" type="text/css" href="../css/main-1220.css">
	<link rel="stylesheet" type="text/css" href="../css/main-1366.css">
	<link rel="stylesheet" type="text/css" href="../css/alerts.css">
	<script type="text/javascript" src="../js/moment.js"></script>
	<script type="text/javascript" src="../js/dynamic.js"></script>
</head>

<body onload ="getDate('control-date',0);">
    
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
                    <button onclick="window.location.href = '';" class="main-menu-item">
                        <img src="../res/img/book-icon-black.png">
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
                <button id="current-item" onclick="window.location.href = '';" class="main-menu-item menu-item">
                    <img src="../res/img/bill-icon-white.png">
                    <p>Facturación</p>
                </button>

                <button onclick="window.location.href = '../includes/logout.php';" class="main-menu-item menu-item">
                    <img src="../res/img/logout-icon-black.png">
                    <p>Cerrar sesión</p>
                </button>
        </header>
    
    <div class="marco nearly-page">
        <h1>FACTURACIÓN</h1>
        <div class="series">
            <p class="types"><b>FACTURA DE VENTA</b></p>
            <p>No&nbsp;&nbsp;&nbsp;&nbsp; C 287</p>
        </div>
        <div class="infos">
            <p><b>Nombre: </b>Juan Eduardo Rodriguez Tobos</p>
            <p><b>Empresa: </b>Nutresa S.A.  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Teléfono: </b>7425643</p>
            <p><b>NIT: </b>890.900.050 – 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Habitación: </b>202 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Fecha Entrada: </b>20/11/2019 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Fecha Salida: </b>25/11/2019</p>
        </div>
            
        <div class="tables">
            <table>
                <tr>
                    <th class="long_cols">Descripción</th>
                    <th>Cantidad</th>
                    <th>Valor Unitario</th>
                    <th class="long_values">Valor Total</th>
                </tr>
                <tr>
                    <td>Hospedaje habitación ejecutiva</td>
                    <td>2</td>
                    <td>$80.000</td>
                    <td>$160.000</td>
                </tr>
                <tr>
                    <td>Minibar</td>
                    <td>5</td>
                    <td>$8.000</td>
                    <td>$16.000</td>
                </tr>
                <tr>
                    <td>Servicio de lavandería</td>
                    <td>4</td>
                    <td>$3.000</td>
                    <td>$12.000</td>
                </tr>
            </table>
        </div>
        
        
            
        <div class="table_totals">
            <table>
                <tr class="long_letters">
                    <td class="long_totals"></td>
                    <td><b>Total $</b></td>
                    <td class="long_values">$188.000</td>
                </tr>
            </table>
        </div>
        
        <div class="option_bill">
            <form action="" method="POST">
                <input type="submit" value="Imprimir factura" name="crear"/>
            </form> 
            
            <a onclick="showModal('submit_bill')">Enviar al correo</a>
        </div>
       
    </div>
    
    
        <div id="submit_bill" class="modal" onclick="touchOutside(this);">
            <div class="modal-content">
                <div class="modal-header">
                    <span onclick="hideModal('add-bizz');" class="close">&times;</span>
                    <h2>ENVÍO DE FACTURA</h2>
                </div>
                <div class="modal-body">
                    <div class="marco full-page">
                        <div class="input-block">
                            <label>Correo</label>
                            <br>
                            <input type="text" placeholder="Correo electrónico">
                        </div>
                    </div>
                    <a onclick="showAlert('alert-i');" id="button-book-bizz">Enviar correo</a>
                </div>
            </div>
        </div>
    
    
    

	<div id="aux-footer" class="col-12"></div>
	<footer>
        <a href="index.php" class="info">Hotel Aristo</a> &copy; 2019 | Todos los derechos reservados
    </footer>

</body>
</html>