<?php
    require '../vendor/autoload.php';
    require '../../includes/database2.php';
    require '../../includes/reportSpreadsheet.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\RichText\RichText;
    use PhpOffice\PhpSpreadsheet\Style\Color;
    use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
    use PhpOffice\PhpSpreadsheet\Shared\Date;
    use PhpOffice\PhpSpreadsheet\Calculation\DateTime;

    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $database = new Database2();

    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(11);

       

    //Alinear contenido de celda
    $spreadsheet->getActiveSheet()->getStyle('A1:AF100')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:AF100')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    //Titulo
    /*$spreadsheet->getActiveSheet()
        ->setCellValue('A1', "HOTEL ARISTO");
*/
    $spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
    $richText = new RichText();
    $payable = $richText->createTextRun('HOTEL ARISTO');
    $payable->getFont()->setBold(true);
    $payable->getFont()->setSize(20);
    $payable->getFont()->setName('Arial');
    $payable->getFont()->setColor( new Color(Color::COLOR_BLUE));
    $spreadsheet->getActiveSheet()->getCell('A1')->setValue($richText);
    
    $spreadsheet->getActiveSheet()
        ->getCell('A1')
        ->getHyperlink()
        ->setUrl('https://test-hotelaristo-v1.000webhostapp.com/login')
        ->setTooltip('Ir a página web');

    //Unir celdas
    $spreadsheet->getActiveSheet()->mergeCells("A1:S1");

    //Agregar estilo al fondo
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(30);
    
    
    //Ancho de celda
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $spreadsheet->getActiveSheet()->getRowDimension(2)->setRowHeight(48);

    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);

    $box = ord('C');
    for ($i = 1; $i <= 17; $i++) {
        $spreadsheet->getActiveSheet()->getColumnDimension(chr($box))->setWidth(12);
        $box++;
    }

    $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(14);
    $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(14);
    $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(14);
    
    $box = ord('A');
    for ($i = 1; $i <= 6; $i++) {
        $spreadsheet->getActiveSheet()->getColumnDimension('A'.chr($box))->setWidth(12);
        $box++;
    }

    
    //Ajustar texto en todas las columnas utilizadas
    $spreadsheet->getActiveSheet()->getStyle('A1:AF100')->getAlignment()->setWrapText(true);
    
    // Texto de encabezado
    $spreadsheet->getActiveSheet()->getStyle('A2:Z2')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()
        ->setCellValue('A2', "Venta por día");
    $spreadsheet->getActiveSheet()
        ->setCellValue('B2', "Días");
    

    
    $rs = new ReportSpreadsheet();
    $rs->fullRoom('C', 2, 201, 17, $spreadsheet);
   
    
    $spreadsheet->getActiveSheet()->setCellValue('U2', "Venta Total de Hospedaje");
    $spreadsheet->getActiveSheet()->setCellValue('V2', "Venta Promedio por Habitación");
    $spreadsheet->getActiveSheet()->setCellValue('W2', "Venta Promedio por Día");
    $spreadsheet->getActiveSheet()->setCellValue('X2', "Total Ocupación");
    $spreadsheet->getActiveSheet()->setCellValue('Y2', "Ocupación Promedio por Habitación");
    $spreadsheet->getActiveSheet()->setCellValue('Z2', "Ocupación Promedio por Día");
    
    $rs->activeBoldCell($spreadsheet, 'U6:V25');
    $rs->activeBoldCell($spreadsheet, 'W11:AF12');
    $rs->activeBoldCell($spreadsheet, 'W15:AF16');
    $rs->activeBoldCell($spreadsheet, 'W19:AF20');
    $rs->activeBoldCell($spreadsheet, 'W23:AF24');
    $rs->activeBoldCell($spreadsheet, 'A34');
    $rs->activeBoldCell($spreadsheet, 'A35');
    

    $spreadsheet->getActiveSheet()->mergeCells("U6:V6");
    $spreadsheet->getActiveSheet()->setCellValue('U6', "Pago en Efectivo");
    $spreadsheet->getActiveSheet()->mergeCells("U7:V7");
    $spreadsheet->getActiveSheet()->setCellValue('U7', "Pago por Datáfono");
    $spreadsheet->getActiveSheet()->mergeCells("U8:V8");
    $spreadsheet->getActiveSheet()->setCellValue('U8', "Pago por Consignación");
    $spreadsheet->getActiveSheet()->mergeCells("U9:V9");
    $spreadsheet->getActiveSheet()->setCellValue('U9', "Cuentas por Cobrar");

    
    $spreadsheet->getActiveSheet()->mergeCells("U11:V13");
    $spreadsheet->getActiveSheet()->setCellValue('U11', "Habitación Sencilla");
    $spreadsheet->getActiveSheet()->mergeCells("W11:X11");
    $spreadsheet->getActiveSheet()
        ->getStyle('W11:AF11')
        ->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);
    $spreadsheet->getActiveSheet()->setCellValue('W11', "85000");
    $spreadsheet->getActiveSheet()->mergeCells("Y11:Z11");
    $spreadsheet->getActiveSheet()->setCellValue('Y11', "80000");
    $spreadsheet->getActiveSheet()->mergeCells("AA11:AB11");
    $spreadsheet->getActiveSheet()->setCellValue('AA11', "75000");
    $spreadsheet->getActiveSheet()->mergeCells("AC11:AD11");
    $spreadsheet->getActiveSheet()->setCellValue('AC11', "70000");
    $spreadsheet->getActiveSheet()->mergeCells("AE11:AF11");
    $spreadsheet->getActiveSheet()->setCellValue('AE11', "TOTAL");

    
    $count = "Conteo";
    $sale = "Venta";
    
    $rs->getCountSale('W', '12', 10, $spreadsheet);

    $spreadsheet->getActiveSheet()->mergeCells("U15:V17");
    $spreadsheet->getActiveSheet()->setCellValue('U15', "Habitación Pareja");
    $spreadsheet->getActiveSheet()->mergeCells("W15:X15");
    $spreadsheet->getActiveSheet()
        ->getStyle('W15:AF15')
        ->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);
    $spreadsheet->getActiveSheet()->setCellValue('W15', "115000");
    $spreadsheet->getActiveSheet()->mergeCells("Y15:Z15");
    $spreadsheet->getActiveSheet()->setCellValue('Y15', "110000");
    $spreadsheet->getActiveSheet()->mergeCells("AA15:AB15");
    $spreadsheet->getActiveSheet()->setCellValue('AA15', "105000");
    $spreadsheet->getActiveSheet()->mergeCells("AC15:AD15");
    $spreadsheet->getActiveSheet()->setCellValue('AC15', "100000");
    $spreadsheet->getActiveSheet()->mergeCells("AE15:AF15");
    $spreadsheet->getActiveSheet()->setCellValue('AE15', "TOTAL");
    
    
    $rs->getCountSale('W', '16', 10, $spreadsheet);


    $spreadsheet->getActiveSheet()->mergeCells("U19:V21");
    $spreadsheet->getActiveSheet()->setCellValue('U19', "Habitación Doble");
    $spreadsheet->getActiveSheet()->mergeCells("W19:X19");
    $spreadsheet->getActiveSheet()
        ->getStyle('W19:AF19')
        ->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);
    $spreadsheet->getActiveSheet()->setCellValue('W19', "125000");
    $spreadsheet->getActiveSheet()->mergeCells("Y19:Z19");
    $spreadsheet->getActiveSheet()->setCellValue('Y19', "120000");
    $spreadsheet->getActiveSheet()->mergeCells("AA19:AB19");
    $spreadsheet->getActiveSheet()->setCellValue('AA19', "TOTAL");

    $rs->getCountSale('W', '20', 6, $spreadsheet);


    $spreadsheet->getActiveSheet()->mergeCells("U23:V25");
    $spreadsheet->getActiveSheet()->setCellValue('U23', "Habitación Triple");
    $spreadsheet->getActiveSheet()->mergeCells("W23:X23");
    $spreadsheet->getActiveSheet()->setCellValue('W23', "< $130,000");

    $rs->getCountSale('W', '24', 2, $spreadsheet);



    $spreadsheet->getActiveSheet()->mergeCells("A34:B34");
    $spreadsheet->getActiveSheet()->mergeCells("A35:B35");
    $spreadsheet->getActiveSheet()->getStyle('A34')->getFont()->setSize(9);
    $spreadsheet->getActiveSheet()->setCellValue('A34', "Venta Total por Habitación");
    $spreadsheet->getActiveSheet()->getStyle('A35')->getFont()->setSize(9);
    $spreadsheet->getActiveSheet()->setCellValue('A35', "Conteo Total por Habitación");

    
    $spreadsheet->getActiveSheet()
        ->getStyle('C34:S34')
        ->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);
    
    $rs->getSalePerRoom('C', '34', $spreadsheet);
    
    

    /*$dateTimeNow = strtotime((string)(30)."-02-2020"."+ 1 days");
    $spreadsheet->getActiveSheet()->getStyle('E5')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
    $spreadsheet->getActiveSheet()->setCellValue('E5', Date::PHPToExcel($dateTimeNow));*/

    $rs->getDateMonth(11, 2019, $spreadsheet);
    $rs->fullValuesPerRoom(201, 'C', $spreadsheet, 11, 2019);

    /*$value = $worksheet->getCell('A1')->getValue();
    $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value);*/
    
    /*$spreadsheet->getActiveSheet()->setCellValue('U2', "Venta Total de Hospedaje");
    $spreadsheet->getActiveSheet()->setCellValue('U2', "Venta Total de Hospedaje");*/

    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
    
    
    

    /*header('Content-Disposition: attachment;filename="Reporte_Empresas.xlsx"');
    */

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    
?>