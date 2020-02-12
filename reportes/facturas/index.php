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
    $queryRoom = $db->connect()->prepare('SELECT COUNT(id_registro_habitacion) AS cantidad, valor_ocupacion AS valorUnitario, GROUP_CONCAT(DISTINCT(numero_habitacion) SEPARATOR ",") AS habitaciones, (valor_ocupacion*COUNT(id_registro_habitacion)) AS valor_total
                FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
                LEFT JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
                LEFT JOIN tarifas tf ON tf.id_tarifa=rh.id_tarifa
                LEFT JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion 
                WHERE r.id_reserva=:idReserva
                GROUP BY valorUnitario');
    $queryRoom->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryRoom->rowCount(); 

    
    //Declaración de la consulta - productos
    $queryProducts = $db->connect()->prepare('SELECT SUM(cantidad_producto*valor_producto) minibar
            FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
            INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
            INNER JOIN peticiones pt ON cd.id_control=pt.id_control
            INNER JOIN productos pd ON pd.id_producto=pt.id_producto
            WHERE r.id_reserva=:idReserva');
    $queryProducts->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryProducts->rowCount(); 


    //Declaración de la consulta - servicio de lavandería
    $queryServiceLaundry = $db->connect()->prepare('SELECT SUM(cantidad_servicio*valor_servicio) AS valor_lavanderia
            FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
            INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
            INNER JOIN peticiones pt ON cd.id_control=pt.id_control
            INNER JOIN servicios s ON s.id_servicio=pt.id_servicio
            WHERE r.id_reserva=:idReserva
            AND tipo_servicio = "L"');
    $queryServiceLaundry->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryServiceLaundry->rowCount(); 


    //Declaración de la consulta - servicio de restaurante
    $queryServiceRes = $db->connect()->prepare('SELECT SUM(cantidad_servicio*valor_servicio) AS valor_restaurante
            FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
            INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
            INNER JOIN peticiones pt ON cd.id_control=pt.id_control
            INNER JOIN servicios s ON s.id_servicio=pt.id_servicio
            WHERE r.id_reserva=:idReserva
            AND tipo_servicio = "R"');
    $queryServiceRes->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryServiceRes->rowCount(); 

    //Declaración de la consulta - servicio de restaurante
    $queryPayValue = $db->connect()->prepare('SELECT NVL(abono_reserva, 0)+ NVL(SUM(abono_peticion),0) AS abono
                FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                LEFT JOIN registros_habitacion rh ON rh.id_reserva=r.id_reserva
                LEFT JOIN control_diario c ON c.id_registro_habitacion=rh.id_registro_habitacion
                LEFT JOIN peticiones pt ON pt.id_control=c.id_control
                WHERE r.id_reserva=:idReserva');
    $queryPayValue->execute(['idReserva'=>$idBook]);
    $rowsNum += $queryPayValue->rowCount(); 
    
    
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
    $inLetter = new CifrasEnLetras();

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

    
    $pdf->RoundedRect(155, 35, 50, 14, 3);
    $pdf->Cell(145);
    $pdf->setXY(155,35);
    $pdf->MultiCell(50, 7, utf8_decode($textBill.' NO.         '), '', 'C', 0);

    setlocale(LC_ALL,"es_CO");
    date_default_timezone_set('America/Bogota');

    $pdf->SetTextColor(255,0,0);
    $pdf->setXY(180,43);
    $pdf->Cell(20, 5, $serie, 0, 1, 'L', 0);
    
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',9);
    $pdf->setXY(9,40);
    $pdf->Cell(20, 5, 'NOMBRE: ', 0, 1, 'L', 0);

    $idTitular = "";

    $pdf->setXY(26, 40);
    if($enterprise==Null){
        $idTitular = "IDENTIFICACIÓN: ";
        $pdf->SetFont('Arial');
        $pdf->Cell(100, 5, $name, 0, 1, 'L', 0);
        $pdf->setXY(37, 48);
        $pdf->Cell(30, 5, $document, 0, 1, 'L', 0);
    }else{
        $idTitular = "NIT: ";
        $pdf->SetFont('Arial');
        $pdf->Cell(100, 5, $enterprise, 0, 1, 'L', 0);
        $pdf->setXY(16, 48);
        $pdf->Cell(30, 5, $document, 0, 1, 'L', 0);
    }
    
    $pdf->SetFont('Arial','B',9);
    $pdf->setXY(9, 48);
    $pdf->Cell(28, 5, utf8_decode($idTitular), 0, 1, 'L', 0);
    $pdf->setXY(9, 55);
    $pdf->Cell(28, 5, utf8_decode('HABITACIÓN(ES): '), 0, 1, 'L', 0);
    $pdf->setXY(115, 55);
    $pdf->Cell(28, 5, utf8_decode('CHECK ON: '), 0, 1, 'L', 0);
    $pdf->setXY(166, 55);
    $pdf->Cell(28, 5, utf8_decode('CHECK OUT: '), 0, 1, 'L', 0);
    

    $pdf->SetFont('Arial');
    $pdf->setXY(38, 55);
    $pdf->Cell(25, 5, $listRooms, 0, 1, 'L', 0);
    $pdf->setXY(135, 55);
    $pdf->Cell(25, 5, $dateIn, 0, 1, 'L', 0);
    $pdf->setXY(188, 55);
    $pdf->Cell(25, 5, $dateOut, 0, 1, 'L', 0);
    
    $pdf->setXY(10, 63);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(100,6,utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 0);
    $pdf->Cell(25,6,'CANTIDAD', 1, 0, 'C', 0);
    $pdf->Cell(35,6,'VALOR UNITARIO', 1, 0, 'C', 0);
    $pdf->Cell(35,6,utf8_decode('VALOR TOTAL'), 1, 1, 'C', 0);


    $valueTotal = 0;
    
    
    // Formato y agregación del contenido del reporte
    $pdf->SetFont('Arial','',9);
    
    foreach($queryRoom as $current){
        $pdf->setX(10);
        $pdf->Cell(100, 6, utf8_decode("HOSPEDAJE HABITACIÓN ".$current['habitaciones']), 1, 0, 'C', 0);
        $pdf->Cell(25, 6, utf8_decode($current['cantidad']), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valorUnitario'], 0, '.', '.')), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_total'], 0, '.', '.')), 1, 1, 'C', 0);
        $valueTotal+=$current['valor_total'];
    }


    foreach($queryProducts as $current){
        if($current['minibar']!=Null){
            $pdf->setX(10);
            $pdf->Cell(100, 6, utf8_decode("MINIBAR"), 1, 0, 'C', 0);
            $pdf->Cell(25, 6, utf8_decode("-"), 1, 0, 'C', 0);
            $pdf->Cell(35, 6, utf8_decode("-"), 1, 0, 'C', 0);
            $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['minibar'], 0, '.', '.')), 1, 1, 'C', 0);
            $valueTotal+=$current['minibar'];
        }
    }


    foreach($queryServiceLaundry as $current){
        if($current['valor_lavanderia']!=Null){
            $pdf->setX(10);
            $pdf->Cell(100, 6, utf8_decode("SERVICIO DE LAVANDERÍA"), 1, 0, 'C', 0);
            $pdf->Cell(25, 6, utf8_decode("-"), 1, 0, 'C', 0);
            $pdf->Cell(35, 6, utf8_decode("-"), 1, 0, 'C', 0);
            $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_lavanderia'], 0, '.', '.')), 1, 1, 'C', 0);
            $valueTotal+=$current['valor_lavanderia'];
        }
    }

    
    foreach($queryServiceRes as $current){
        if($current['valor_restaurante']!=Null){
            $pdf->setX(10);
            $pdf->Cell(100, 6, utf8_decode("SERVICIO DE RESTAURANTE"), 1, 0, 'C', 0);
            $pdf->Cell(25, 6, utf8_decode("-"), 1, 0, 'C', 0);
            $pdf->Cell(35, 6, utf8_decode("-"), 1, 0, 'C', 0);
            $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['valor_restaurante'], 0, '.', '.')), 1, 1, 'C', 0);
            $valueTotal+=$current['valor_restaurante'];
        }
    }

    $valuePay = 0;
    foreach($queryPayValue as $current){
        if($current['abono']!=0){
            $pdf->setX(10);
            $pdf->Cell(125, 6, "", 1, 0, 'L', 0);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(35, 6, utf8_decode("VALOR ABONADO"), 1, 0, 'C', 0);
            $pdf->Cell(35, 6, utf8_decode('$'.number_format($current['abono'], 0, '.', '.')), 1, 1, 'C', 0);
            $valuePay=$current['abono'];
        }
    }

    $pdf->setX(10);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(125, 10, utf8_decode(" SON: ".strtoupper($inLetter->convertirCifrasEnLetras($valueTotal-$valuePay))." PESOS MCTE"), 1, 0, 'L', 0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(35, 10, utf8_decode("VALOR TOTAL"), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, '$'.number_format($valueTotal-$valuePay, 0, '.', '.'), 1, 1, 'C', 0);
    $pdf->SetFont('Arial','',8);
    
    $pdf->setX(6);  
    $pdf->Cell(199, 4, utf8_decode('Esta factura se asimila en todos sus efectos legales a una Letra de Cambio según el Art. 774 del Código de Comercio'), 0, 1, 'C', 0);
    
    $pdf->ln(10);
    $pdf->setX(10);  
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(15, 4, utf8_decode('CLIENTE'), 0, 0, 'L', 0);
    $pdf->Cell(64, 3, '', 'B', 0, 'L', 0);    
    $pdf->Cell(45, 4, utf8_decode('RESPONSABLE: '), 0, 0, 'R', 0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(80, 4, utf8_decode($user->getName()." ".$user->getLastName()), 0, 0, 'L', 0);
    

    // Generación del reporte
    $pdf->Output();
    ob_end_flush(); 
?>