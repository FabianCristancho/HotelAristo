<?php
ob_start();
/**
    * Archivo que contiene el reporte con las empresas asociadas con el hotel
    * @package   reportes.empresas
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación de las clases requeridas para el buen funcionamiento de la aplicación
    */
    include '../../includes/classes.php';
    include '../report.php';
    
    
    $user = new User();
    $userSession = new UserSession();

    if(isset($_SESSION['user'])){
        $user->updateDBUser($userSession->getSession());
    }else{
        header('location: /login');
    }

    /**
    * Declaración de objetos que permiten  realizar consultas desde la base de datos
    **/
    $db = new Database();
    $consult = new Consult();


    /**
    * Declaración de consultas y parámetros necesarios
    **/
    $idBook = $_GET['id'];
    $typeBill = $_GET['typeBill'];
    $serie = $_GET['serie'];
    $rowsNum = 0;

    // Declaración de la consulta - datos personales
    $queryPersonalData = $db->connect()->prepare('SELECT numero_documento, CONCAT_WS(" ", nombres_persona, apellidos_persona) AS nombres, telefono_persona, nombre_empresa, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fecha_ingreso, DATE_FORMAT(fecha_salida, "%d/%m/%Y") AS fecha_salida, GROUP_CONCAT(DISTINCT(numero_habitacion) SEPARATOR ",") AS habitaciones 
                                        FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                                        LEFT JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            							LEFT JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
                                        LEFT JOIN empresas e ON r.id_empresa=e.id_empresa
                                        WHERE r.id_reserva=:idReserva');
    $queryPersonalData->execute(['idReserva'=>$idBook]);


    //Declaración de la consulta - habitaciones
    $queryRoom = $db->connect()->prepare('SELECT numero_habitacion, valor_ocupacion
                                        FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
                                        LEFT JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
                                        LEFT JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
                                        LEFT JOIN tarifas tf ON tf.id_tarifa=rh.id_tarifa
                                        WHERE r.id_reserva=:idReserva');
    $queryRoom->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryRoom->rowCount(); 

    
    //Declaración de la consulta - productos
    $queryProducts = $db->connect()->prepare('SELECT nombre_producto, cantidad_producto, valor_producto AS valor_unitario, (cantidad_producto*valor_producto) AS valor_total
                                        FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
                                        INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
                                        INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
                                        INNER JOIN peticiones pt ON cd.id_control=pt.id_control
                                        INNER JOIN productos pd ON pd.id_producto=pt.id_producto
                                        WHERE r.id_reserva=:idReserva');
    $queryProducts->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryProducts->rowCount(); 


    //Declaración de la consulta - servicios
    $queryServices = $db->connect()->prepare('SELECT nombre_servicio, cantidad_servicio, valor_servicio AS valor_unitario, (valor_servicio*cantidad_servicio) AS valor_total
                                        FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
                                        INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
                                        INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
                                        INNER JOIN peticiones pt ON cd.id_control=pt.id_control
                                        INNER JOIN servicios s ON s.id_servicio=pt.id_servicio
                                        WHERE r.id_reserva=:idReserva');
    $queryServices->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryServices->rowCount(); 

    
    
    /**
    * Asignación del tamaño y márgenes de la hoja
    **/
    $orientation = "P";
    $pageSize = array(216, 279);
    if($rowsNum > 6){
        $orientation = "P";
        $pageSize = array(216, 279);
    }

    $pdf = new Report($orientation,'mm',$pageSize);
    $pdf->SetAutoPageBreak(true,2); 



    $name;
    $document;
    $phone;
    $enterprise;
    $textBill = "";
    $listRooms = "";
    $dateIn;
    $dateOut;

    if($typeBill==0){
        $textBill = "  FACTURA DE VENTA  ";
        if(strcmp($serie, 'NEW') == 0)
            $serie = $consult->getLastSerieBill();
        
    }else{
        $textBill = "ORDEN DE SERVICIO";
        if(strcmp($serie, 'NEW') == 0)
            $serie = $consult->getLastSerieOrder();
    }
    
    foreach($queryPersonalData  as $current){
        $name = $current['nombres'];
        $document = $current['numero_documento'];
        $phone = $current['telefono_persona'];
        $enterprise = $current['nombre_empresa'];
        $listRooms = $current['habitaciones'];
        $dateIn = $current['fecha_ingreso'];
        $dateOut = $current['fecha_salida'];
    }
        
    

    // Cabecera del reporte
    $pdf->AddPage();
    $pdf->Header('');
    $pdf->SetFont('Arial','B',11);

    
    $pdf->Cell(145);
    $pdf->setXY(155,30);
    $pdf->MultiCell(50, 7, utf8_decode($textBill.' NO.   '.$serie), 'LTRB', 'C', 0);

    setlocale(LC_ALL,"es_CO");
    date_default_timezone_set('America/Bogota');
    
    $pdf->setXY(155,45);
    $pdf->Cell(20, 8, 'FECHA', 1, 0, 'C', 0);
    $pdf->SetTextColor(0,0,0);
    $pdf->setXY(175,45);
    $pdf->Cell(10, 8, date("d"), 1, 0, 'C', 0);
    $pdf->setXY(185,45);
    $pdf->Cell(10, 8, date("m"), 1, 0, 'C', 0);
    $pdf->setXY(195,45);
    $pdf->Cell(10, 8, date("y"), 1, 0, 'C', 0);

    
    $pdf->SetFont('Arial','B',9);
    $pdf->setXY(5,40);
    $pdf->Cell(20, 5, 'NOMBRE: ', 0, 1, 'L', 0);

    $coordPhone = 90;
    $coordValuePhone = 110;
    if(empty($enterprise)){
        $coordPhone = 6;
        $coordValuePhone = 25;
    }else{
        $pdf->setXY(5,48);
        $pdf->Cell(20, 5, 'EMPRESA: ', 0, 1, 'L', 0);
        $pdf->setXY(25, 48);
        $pdf->Cell(60, 5, $enterprise, 0, 1, 'L', 0);
    }
        
    $pdf->setXY($coordPhone, 48);
    $pdf->Cell(20, 5, utf8_decode('TELÉFONO: '), 0, 1, 'R', 0);
    $pdf->setXY(5, 55);
    $pdf->Cell(28, 5, utf8_decode('IDENTIFICACIÓN: '), 0, 1, 'L', 0);
    $pdf->setXY(55, 55);
    $pdf->Cell(28, 5, utf8_decode('HABITACIÓN(ES): '), 0, 1, 'L', 0);
    $pdf->setXY(110, 55);
    $pdf->Cell(28, 5, utf8_decode('FECHA ENTRADA: '), 0, 1, 'L', 0);
    $pdf->setXY(160, 55);
    $pdf->Cell(28, 5, utf8_decode('FECHA SALIDA: '), 0, 1, 'L', 0);
    $pdf->SetFont('Arial');
    
    
    $pdf->setFont('Arial');
    $pdf->setXY(25, 40);
    $pdf->Cell(100, 5, $name, 0, 1, 'L', 0);
    $pdf->setXY($coordValuePhone, 48);
    $pdf->Cell(30, 5, $phone, 0, 1, 'L', 0);
    $pdf->setXY(33, 55);
    $pdf->Cell(30, 5, $document, 0, 1, 'L', 0);
    $pdf->setXY(83, 55);
    $pdf->Cell(25, 5, $listRooms, 0, 1, 'L', 0);
    $pdf->setXY(140, 55);
    $pdf->Cell(25, 5, $dateIn, 0, 1, 'L', 0);
    $pdf->setXY(188, 55);
    $pdf->Cell(25, 5, $dateOut, 0, 1, 'L', 0);
    
    $pdf->setXY(6, 62);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(104,6,utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 0);
    $pdf->Cell(25,6,'CANTIDAD', 1, 0, 'C', 0);
    $pdf->Cell(35,6,'VALOR UNITARIO', 1, 0, 'C', 0);
    $pdf->Cell(35,6,utf8_decode('VALOR TOTAL'), 1, 1, 'C', 0);


    $valueTotal = 0;
    
    
    // Formato y agregación del contenido del reporte
    $pdf->SetFont('Arial','',9);
    
    foreach($queryRoom as $current){
        $pdf->setX(6);
        $pdf->Cell(104, 6, utf8_decode("HABITACIÓN ".$current['numero_habitacion']), 1, 0, 'C', 0);
        $pdf->Cell(25, 6, utf8_decode("1"), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_ocupacion'], 0, '.', '.')), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_ocupacion'], 0, '.', '.')), 1, 1, 'C', 0);
        $valueTotal+=$current['valor_ocupacion'];
    }



    

    foreach($queryProducts as $current){
        $pdf->setX(6);
        $pdf->Cell(104, 6, utf8_decode("PRODUCTO ".$current['nombre_producto']), 1, 0, 'C', 0);
        $pdf->Cell(25, 6, utf8_decode($current['cantidad_producto']), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_unitario'], 0, '.', '.')), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_total'], 0, '.', '.')), 1, 1, 'C', 0);
        $valueTotal+=$current['valor_total'];
    }



    //Declaración de la consulta - servicios
    $queryServices = $db->connect()->prepare('SELECT nombre_servicio, cantidad_servicio, valor_servicio AS valor_unitario, (valor_servicio*cantidad_servicio) AS valor_total
                                        FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
                                        INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
                                        INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
                                        INNER JOIN peticiones pt ON cd.id_control=pt.id_control
                                        INNER JOIN servicios s ON s.id_servicio=pt.id_servicio
                                        WHERE r.id_reserva=:idReserva');
    $queryServices->execute(['idReserva'=>$idBook]);

    foreach($queryServices as $current){
        $pdf->setX(6);
        $pdf->Cell(104, 6, utf8_decode("SERVICIO DE ".$current['nombre_servicio']), 1, 0, 'C', 0);
        $pdf->Cell(25, 6, utf8_decode($current['cantidad_servicio']), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_unitario'], 0, '.', '.')), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_total'], 0, '.', '.')), 1, 1, 'C', 0);
        $valueTotal+=$current['valor_total'];
    }

    $pdf->setX(6);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(129, 10, utf8_decode("SON"), 1, 0, 'L', 0);
    $pdf->Cell(35, 10, utf8_decode("TOTAL"), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, '$'.number_format($valueTotal, 0, '.', '.'), 1, 1, 'C', 0);
    $pdf->SetFont('Arial','',8);
    
    $pdf->setX(6);  
    $pdf->Cell(199, 4, utf8_decode('Esta factura se asimila en todos sus efectos legales a una Letra de Cambio según el Art. 774 del Código de Comercio'), 0, 1, 'C', 0);
    
    $pdf->ln(10);
    $pdf->setX(6);  
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(15, 4, utf8_decode('CLIENTE'), 0, 0, 'L', 0);
    $pdf->Cell(70, 3, '', 'B', 0, 'L', 0);    
    $pdf->Cell(45, 4, utf8_decode('RESPONSABLE: '), 0, 0, 'R', 0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(80, 4, utf8_decode($user->getName()." ".$user->getLastName()), 0, 0, 'L', 0);
    

    // Generación del reporte
    $pdf->Output();
    ob_end_flush(); 
?>