<?php
    /**
    * Clase Report. Contiene la plantilla utilizada para el hotel, con el fin de dar un formato establecido a los reportes que se requieren 
    * @package   reportes
    * @author    Andrés Felipe Chaparro Rosas - Fabian Alejandro Cristancho Rincón
    * @copyright Todos los derechos reservados. 2020.
    * @since     Versión 1.0
    * @version   1.0
    */

    /**
    * Incluye la implementación del archivo fpdf necesario para la exitosa generación de reportes
    */
    require('fpdf.php');

    class Report extends FPDF {

        /**
        * Función que contiene el formato de cabecera del reporte
        */
        function Header($title)
        {
            // Logo
            $this->Image('../../res/img/logoA.png',5,6,23);
            $this->Image('../../res/img/titulo_aristo.png',32,9,44);
            // Arial bold 18
            $this->SetFont('Arial','B',18);
            // Movernos a la derecha
            $this->Cell(55);
            // Título
            $this->Cell(150,70,$title,0,0,'C');
            $this->SetFont('Arial','',8);
            //Color de letra
            $this->SetTextColor(24, 52, 125);
            //Información Administración del hotel
            $this->Cell(-200);
            $this->Cell(200,2,utf8_decode('HENRY QUINTERO'),0,0,'C');
            $this->Cell(-200,10,utf8_decode('NIT. 16.136.920-4'),0,0,'C');
            $this->Cell(200,18,utf8_decode('RÉGIMEN SIMPLIFICADO'),0,0,'C');
            // Movernos a la derecha
            $this->Cell(50);
            // Información del hotel
            $this->Cell(0,2,utf8_decode('AVENIDA NORTE N° 45-22'),0,0,'R');
            $this->Cell(0,10,utf8_decode('CEL. 3213815571'),0,0,'R');
            $this->Cell(0,18,utf8_decode('TEL. 7469911'),0,0,'R');
            $this->Cell(0,26,utf8_decode('Email: hotelaristo@hotmail.com'),0,0,'R');
            $this->Cell(0,34,utf8_decode('TUNJA - BOYACÁ'),0,0,'R');
            // Salto de línea
            //$this->Ln(20);
        }

        /**
        * Función que contiene el formato de salto de página del reporte
        
        function Footer()
        {
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
            $this->AliasNbPages();
        }*/
    }
?>