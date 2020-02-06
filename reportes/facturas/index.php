<?php
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

    // Declaración de los objetos requeridos
    $db = new Database();
    $pdf = new Report('L','mm',array(140, 216));    

    // Declaración de la consulta
    $query = $db->connect()->prepare('SELECT * FROM empresas');
    $query->execute();

    

    // Cabecera del reporte
    $pdf->AddPage();
    $pdf->Header('');
    $pdf->SetFont('Arial','B',11);
    //Color de texto
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln(25);

    $pdf->Cell(28,7,'NIT', 1, 0, 'C', 0);
    $pdf->Cell(75,7,'NOMBRE', 1, 0, 'C', 0);
    $pdf->Cell(80,7,'CORREO', 1, 0, 'C', 0);
    $pdf->Cell(25,7,utf8_decode('TELÉFONO'), 1, 0, 'C', 0);
    $pdf->Cell(28,7,utf8_decode('RETEFUENTE'), 1, 0, 'C', 0);
    $pdf->Cell(40,7,utf8_decode('OTRO IMPUESTO'), 1, 1, 'C', 0);
    
    // Formato y agregación del contenido del reporte
    $pdf->SetFont('Arial','',10);
    
    foreach ($query as $current) {
        $pdf->Cell(28,7,utf8_decode($current['nombre_empresa']), 1, 0, 'C', 0);
        $pdf->Cell(75,7,utf8_decode($current['nit_empresa']), 1, 0, 'C', 0);
        $pdf->Cell(80,7,utf8_decode($current['correo_empresa']), 1, 0, 'C', 0);
        $pdf->Cell(25,7,utf8_decode($current['telefono_empresa']), 1, 1, 'C', 0);
    }

    // Generación del reporte
    $pdf->Output();
?>