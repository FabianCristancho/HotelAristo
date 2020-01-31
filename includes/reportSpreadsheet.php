<?php
    use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
    use PhpOffice\PhpSpreadsheet\Shared\Date;
    class ReportSpreadsheet extends Database2{
        
        
         function fullRoom($numberCol, $numberRow, $firstRoom, $cantRooms, $spreadsheet){
            $box = ord($numberCol);
            $room = $firstRoom;
    
            for ($i = 0; $i < $cantRooms; $i++) {
                $spreadsheet->getActiveSheet()->setCellValue(chr($box).$numberRow, $room);
                if($room==202){
                    $room=301;
                }else if(($room==304)||($room==404)||($room==504)){
                    $room+=97;
                }else{
                    $room++;    
                }
                
                $box++;
            }
        }
        
        function getCountSale($col, $row, $iterations, $spreadsheet){
            $box = ord($col);
            $aux = '';
            for($i=0;$i<$iterations;$i++){
                if($i%2==0)
                    $spreadsheet->getActiveSheet()->setCellValue($aux.chr($box).$row, 'Conteo');
                else
                    $spreadsheet->getActiveSheet()->setCellValue($aux.chr($box).$row, 'Venta');

                if($box==ord('Z')){
                    $box = ord('@');
                    $aux = 'A';
                }
                $box++;
            }
        }
        
        function getSalePerRoom($firstCol, $row, $spreadsheet){
            $query = $this->connect()->prepare('SELECT numero_habitacion, SUM(valor_ocupacion*(fecha_salida-fecha_ingreso+1)) AS value 
            FROM tarifas t INNER JOIN registros_habitacion rh ON t.id_tarifa=rh.id_tarifa
            INNER JOIN reservas r ON r.id_reserva=rh.id_reserva
            INNER JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
            GROUP BY numero_habitacion
            ORDER BY numero_habitacion;');
            $query->execute();
            $cantCharges;
            $numberCol = ord($firstCol);

            foreach ($query as $current) {
                $spreadsheet->getActiveSheet()->setCellValue(chr($numberCol).$row, $current['value']);
                $numberCol++;
            }
        }
        
        
        function getDateMonth($month, $year, $spreadsheet){
            $numberDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $row = 3;
            $day = 1;
            
            for($i=0;$i<$numberDays;$i++){
                $dateTimeNow = strtotime((string)($day).'-'.$month.'-'.$year.'+ 1 days');
                $spreadsheet->getActiveSheet()->getStyle('B'.$row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row, Date::PHPToExcel($dateTimeNow)); 
                $day++;
                $row++;
            }  
        }
        
        
        
        
        
        function fullValuesPerRoom($room, $col, $spreadsheet, $month, $year){
            $numberDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $day = 1;
            $row = 3;
            $colExcelDate = 2;
            $rowExcelDate = 3;
            
            $query = $this->connect()->prepare('SELECT valor_ocupacion, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fi, DATE_FORMAT(fecha_salida, "%d/%m/%Y") AS fs, SUM(fecha_salida - fecha_ingreso + 1) AS dif 
            FROM tarifas t INNER JOIN registros_habitacion rh ON t.id_tarifa=rh.id_tarifa
            INNER JOIN reservas r ON r.id_reserva=rh.id_reserva
            INNER JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
            WHERE h.numero_habitacion = :room
            GROUP BY 1, 2, 3
            ORDER BY fi, fs');
            $query->execute(['room'=>$room]);
            
            $dateTimeNow = strtotime((string)($day).'/'.$month.'/'.$year.'+ 1 days');

            foreach ($query as $current) {
                
                //$val = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($colExcelDate, $rowExcelDate)->getValue();
                //$aux = Date::excelToTimestamp($val); //formato unix timestamp
                
                $diferenceDates = $current['dif'];
                
                //$fecha_de_excel = date('d/m/Y', $aux); //string
                //$fecha_ingreso_bd = date_create($current['fi']);
                //$fecha_de_excel = $aux; //string
                //$newDate = date("d/m/Y", strtotime($current['fi']));
                $dateString = date('d/m/Y', $dateTimeNow);
                
                while(strcmp ($current['fi'] , $dateString )!=0 && $day<$numberDays){
                    $day++;
                    $dateTimeNow = strtotime((string)($day).'/'.$month.'/'.$year.'+ 1 days');
                }
                
                $dateString = date('d/m/Y', $dateTimeNow);
                if(strcmp ($current['fi'] , $dateString )==0){
                    for($i=0;$i<$diferenceDates;$i++){
                        $spreadsheet->getActiveSheet()->setCellValue($col.$row, $current['valor_ocupacion']);
                        $row++;
                    }
                }else{
                    $spreadsheet->getActiveSheet()->setCellValue('E5', $dateString);
                }
                
                
                /*for($i=0;$i<$numberDays;$i++){
                    $dateTimeNow = strtotime((string)($day).'-'.$month.'-'.$year.'+ 1 days');
                    $spreadsheet->getActiveSheet()->getStyle('B'.$row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                    $spreadsheet->getActiveSheet()->setCellValue('B'.$row, Date::PHPToExcel($dateTimeNow)); 
                    $day++;
                    $row++;
                } */
                
                
                
                //$fecha_ingreso_bd = strtotime($newDate."+ 1 days");
                //$cad = (string)($current['fi']);
                //$dateTimeNow = date('d/m/Y', strtotime($cad));
                //$spreadsheet->getActiveSheet()->getStyle('E5')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                //$spreadsheet->getActiveSheet()->setCellValue('E5', Date::PHPToExcel($dateTimeNow)); 
                //$spreadsheet->getActiveSheet()->setCellValue('E4', $current['fi']); 
                //$spreadsheet->getActiveSheet()->getStyle('E6')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                //$cadena_nueva = date_format($fecha_de_excel, 'd/m/Y');
                 //$spreadsheet->getActiveSheet()->setCellValue('C4', $fecha_de_excel); 
                //$spreadsheet->getActiveSheet()->setCellValue('E6', $fecha_de_excel);
                
                
               // $spreadsheet->getActiveSheet()->getStyle('E5')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD2);
                //$spreadsheet->getActiveSheet()->setCellValue('E5', Date::timestampToExcel($fecha_ingreso_bd));
                //echo 'Excel vale: '.$fecha_de_excel;
                //echo 'Bases vale: '.$cad;
                //echo 'Bases es: '.$current['fi'].'|||||||||';
                //echo $fecha_de_excel+$fecha_ingreso_bd;
                //$interval = $fecha_de_excel->diff($fecha_ingreso_bd);
                //echo 'Fecha es '.$current['fi'];
                //$result = $fecha_ingreso_bd->format('d/m/Y');
                //echo $result;
               //$interval = $aux2->format('D');
                
                /*if(strcmp ($current['fi'] , $fecha_de_excel )==0){
                    for($i=0;$i<$diferenceDates;$i++){
                        //echo 'En la fila '.$row.' hay resultados';
                        $spreadsheet->getActiveSheet()->setCellValue($col.$row, $current['valor_ocupacion']);
                        $row++;
                        $rowExcelDate++;
                    }
                }else{
                    //echo 'En la fila '.$row.' NOO hay resultados';
                    $row++;
                    $rowExcelDate++;
                } */
            }
        }
        
        
        
        
        
       /* function fullValuesPerRoom($room, $col, $spreadsheet){
            $row = 4;
            $colExcelDate = 2;
            $rowExcelDate = 3;
            
            $query = $this->connect()->prepare('SELECT valor_ocupacion, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fi, DATE_FORMAT(fecha_salida, "%d/%m/%Y") AS fs, SUM(fecha_salida - fecha_ingreso + 1) AS dif 
            FROM tarifas t INNER JOIN registros_habitacion rh ON t.id_tarifa=rh.id_tarifa
            INNER JOIN reservas r ON r.id_reserva=rh.id_reserva
            INNER JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
            WHERE h.numero_habitacion = :room
            GROUP BY 1, 2, 3
            ORDER BY fi, fs');
            $query->execute(['room'=>$room]);

            foreach ($query as $current) {
                
                $val = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($colExcelDate, $rowExcelDate)->getValue();
                $aux = Date::excelToTimestamp($val); //formato unix timestamp
                
                $diferenceDates = $current['dif'];
                
                $fecha_de_excel = date('d/m/Y', $aux); //string
                //$fecha_ingreso_bd = date_create($current['fi']);
                //$fecha_de_excel = $aux; //string
                //$newDate = date("d/m/Y", strtotime($current['fi']));
                
                
                
                //$fecha_ingreso_bd = strtotime($newDate."+ 1 days");
                //$cad = (string)($current['fi']);
                //$dateTimeNow = date('d/m/Y', strtotime($cad));
                //$spreadsheet->getActiveSheet()->getStyle('E5')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                //$spreadsheet->getActiveSheet()->setCellValue('E5', Date::PHPToExcel($dateTimeNow)); 
                $spreadsheet->getActiveSheet()->setCellValue('E4', $current['fi']); 
                //$spreadsheet->getActiveSheet()->getStyle('E6')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
                //$cadena_nueva = date_format($fecha_de_excel, 'd/m/Y');
                 $spreadsheet->getActiveSheet()->setCellValue('C4', $fecha_de_excel); 
                //$spreadsheet->getActiveSheet()->setCellValue('E6', $fecha_de_excel);
                
                
               // $spreadsheet->getActiveSheet()->getStyle('E5')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD2);
                //$spreadsheet->getActiveSheet()->setCellValue('E5', Date::timestampToExcel($fecha_ingreso_bd));
                //echo 'Excel vale: '.$fecha_de_excel;
                //echo 'Bases vale: '.$cad;
                //echo 'Bases es: '.$current['fi'].'|||||||||';
                //echo $fecha_de_excel+$fecha_ingreso_bd;
                //$interval = $fecha_de_excel->diff($fecha_ingreso_bd);
                //echo 'Fecha es '.$current['fi'];
                //$result = $fecha_ingreso_bd->format('d/m/Y');
                //echo $result;
               //$interval = $aux2->format('D');
                
                if(strcmp ($current['fi'] , $fecha_de_excel )==0){
                    for($i=0;$i<$diferenceDates;$i++){
                        //echo 'En la fila '.$row.' hay resultados';
                        $spreadsheet->getActiveSheet()->setCellValue($col.$row, $current['valor_ocupacion']);
                        $row++;
                        $rowExcelDate++;
                    }
                }else{
                    //echo 'En la fila '.$row.' NOO hay resultados';
                    $row++;
                    $rowExcelDate++;
                } 
            }
        }*/
        
        /*function fullValuesPerRoom($room, $col, $spreadsheet){
            $row = 3;
            $colExcelDate = 2;
            $rowExcelDate = 3;
            
            $query = $this->connect()->prepare('SELECT valor_ocupacion, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fi, DATE_FORMAT(fecha_salida, "%d/%m/%Y") AS fs, SUM(fecha_salida - fecha_ingreso + 1) AS dif 
            FROM tarifas t INNER JOIN registros_habitacion rh ON t.id_tarifa=rh.id_tarifa
            INNER JOIN reservas r ON r.id_reserva=rh.id_reserva
            INNER JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
            WHERE h.numero_habitacion = :room
            GROUP BY 1, 2, 3
            ORDER BY fi, fs');
            $query->execute(['room'=>$room]);

            foreach ($query as $current) {
                
                $val = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($colExcelDate, $rowExcelDate)->getValue();
                $aux = Date::excelToTimestamp($val); //formato unix timestamp
                
                $diferenceDates = $current['dif'];
                
                $fecha_de_excel = date_create(date('d/m/Y', $aux)); 
                $fecha_ingreso_bd = date_create($current['fi']);
                
                $aux2 = date_diff($fecha_de_excel,$fecha_ingreso_bd);
                $interval = $aux2->format('D');
                
                if($interval == 0){
                    for($i=0;$i<$diferenceDates;$i++){
                        $spreadsheet->getActiveSheet()->setCellValue($col.$row, $current['valor_ocupacion']);
                        $row++;
                    }
                }else{
                    $row++;
                }
            }
        }*/
        
        
        function extractDateFromExcel($numberColExtract, $numberRowExtract, $spreadsheet){
            $val = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($numberColExtract, $numberRowExtract)->getValue();
            $aux = Date::excelToTimestamp($val); //formato unix timestamp
            //$spreadsheet->getActiveSheet()->getStyle('E5')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
            //$spreadsheet->getActiveSheet()->setCellValue('E5', Date::PHPToExcel($aux));
        }
        
        
        
        function activeBoldCell($spreadsheet, $range){
            $spreadsheet->getActiveSheet()->getStyle($range)->getFont()->setBold(true);
        }
    }
    
?>