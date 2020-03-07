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

    $typeBill = $_POST['typeBill'];
    //$idBill = $_POST['idBill'];
    $name = $_POST['name'];
    $id = $_POST['id'];
    $enterprise = $_POST['enterprise'];
    $phone = $_POST['phone'];
    $typeId = $_POST['typeId'];
    // $room = $_POST['room'];
    $dateGetIn = $_POST['dateGetIn'];
    $dateGetOut = $_POST['dateGetOut'];
    //$values = $_GET['valores'];
    $desc1 = $_POST['desc1'];
    $unit1 = $_POST['unit1'];
    $cant1 = $_POST['cant1'];
    $vTotal1 = $_POST['vTotal1'];
    $desc2 = $_POST['desc2'];
    $unit2 = $_POST['unit2'];
    $cant2 = $_POST['cant2'];
    $vTotal2 = $_POST['vTotal2'];
    $desc3 = $_POST['desc3'];
    $unit3 = $_POST['unit3'];
    $cant3 = $_POST['cant3'];
    $vTotal3 = $_POST['vTotal3'];
    $valueTotal = $_POST['valueTotal'];
    $resp = $_POST['resp'];


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
    * Asignación del tamaño y márgenes de la hoja
    **/
    $orientation = "P";
    $pageSize = array(216, 279);

    $pdf = new Report($orientation,'mm',$pageSize);
    $pdf->SetAutoPageBreak(true,2); 
    //$inLetter = new CifrasEnLetras();


    /* if($typeBill==0){
        $textBill = "  FACTURA DE VENTA  ";
        if(strcmp($serie, 'NEW') == 0 || strcmp($serie, 'TOPAY') == 0)
            $serie = $consult->getLastSerieBill();
    }else{
        $textBill = "ORDEN DE SERVICIO";
        if(strcmp($serie, 'NEW') == 0 || strcmp($serie, 'TOPAY') == 0)
            $serie = $consult->getLastSerieOrder();
    } */
    
    /* foreach($queryPersonalData  as $current){
        $name = $current['nombres'];
        $document = $current['numero_documento'];
        $phone = $current['telefono_persona'];
        $nit = $current['nit_empresa'];
        $enterprise = $current['nombre_empresa'];
        $listRooms = $current['habitaciones'];
        $dateIn = $current['fecha_ingreso'];
        $dateOut = $current['fecha_salida'];
    } */
        
    

    // Cabecera del reporte
    $pdf->AddPage();
    $pdf->Header('');
    $pdf->SetFont('Arial','B',11);

    
    $pdf->Image('../../res/img/map.png',70,40,80);
    $pdf->RoundedRect(155, 35, 50, 14, 3);
    $pdf->Cell(145);
    $pdf->setXY(155,35);
    $pdf->MultiCell(50, 7, utf8_decode("FACTURA DE VENTA".' NO.         '), '', 'C', 0);

    setlocale(LC_ALL,"es_CO");
    date_default_timezone_set('America/Bogota');

    $pdf->SetTextColor(255,0,0);
    $pdf->setXY(180,43);
    $pdf->Cell(20, 5, "D001", 0, 1, 'L', 0);
    
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',9);
    $pdf->setXY(9,40);
    $pdf->Cell(20, 5, 'NOMBRE: ', 0, 1, 'L', 0);

    $idTitular = "";

    /* $pdf->setXY(26, 40);
    if($enterprise==Null){ */
        $idTitular = "IDENTIFICACIÓN: ";
        $pdf->SetFont('Arial');
        $pdf->setXY(25, 40);
        $pdf->Cell(100, 5, utf8_decode($name), 0, 1, 'L', 0);
    /* }else{
        $idTitular = "NIT: ";
        $pdf->SetFont('Arial');
        $pdf->Cell(100, 5, $enterprise, 0, 1, 'L', 0);
        $pdf->setXY(16, 48);
        $pdf->Cell(30, 5, $nit, 0, 1, 'L', 0);
    } */
    
    $pdf->SetFont('Arial','B',9);
    $pdf->setXY(9, 48);
    $pdf->Cell(28, 5, utf8_decode("EMPRESA:"), 0, 1, 'L', 0);
    $pdf->setXY(30, 48);
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(30, 5, $enterprise, 0, 1, 'L', 0);
    $pdf->setXY(9, 55);
    $pdf->Cell(28, 5, utf8_decode('HABITACIÓN(ES): '), 0, 1, 'L', 0);
    $pdf->setXY(115, 55);
    $pdf->Cell(28, 5, utf8_decode('CHECK IN: '), 0, 1, 'L', 0);
    $pdf->setXY(166, 55);
    $pdf->Cell(28, 5, utf8_decode('CHECK OUT: '), 0, 1, 'L', 0);
    

    $pdf->SetFont('Arial');
    $pdf->setXY(38, 55);
    $pdf->Cell(25, 5, "prov", 0, 1, 'L', 0);
    $pdf->setXY(135, 55);
    $pdf->Cell(25, 5, "prov", 0, 1, 'L', 0);
    $pdf->setXY(188, 55);
    $pdf->Cell(25, 5, "prov", 0, 1, 'L', 0);
    
    $pdf->setXY(10, 63);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(100,6,utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 0);
    $pdf->Cell(25,6,'CANTIDAD', 1, 0, 'C', 0);
    $pdf->Cell(35,6,'VALOR UNITARIO', 1, 0, 'C', 0);
    $pdf->Cell(35,6,utf8_decode('VALOR TOTAL'), 1, 1, 'C', 0);


    $valueTotal = 0;
    
    
    // Formato y agregación del contenido del reporte
    $pdf->SetFont('Arial','',9);
    
    /* if(strcmp($aux, 'TOPAY') != 0){
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
    } */
    

    /* $valuePay = 0;
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

    $pdf->SetFont('Arial','B',10);
    $pdf->setX(10);
    $pdf->Cell(125, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(35, 6, utf8_decode("VALOR A PAGAR"), 1, 0, 'C', 0);
    
    if(strcmp($aux, 'TOPAY') == 0){
        $pdf->Cell(35, 6, '$'.number_format($valuePay, 0, '.', '.'), 1, 1, 'C', 0);
    }else{
        $pdf->Cell(35, 6, '$'.number_format($valueTotal-$valuePay, 0, '.', '.'), 1, 1, 'C', 0);
    }

    $pdf->setX(10);
    $pdf->SetFont('Arial','',8);
    
    $pdf->Cell(125, 10, utf8_decode(" SON: "), 1, 0, 'L', 0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(35, 10, utf8_decode("VALOR TOTAL"), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, '$'.number_format($valueTotal, 0, '.', '.'), 1, 1, 'C', 0); */
    
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