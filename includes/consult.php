<?php
    
    class Consult extends Database {
        public function getList($entity, $aux,string $aux2=null){
            switch ($entity) {
                case 'roomType':
                    $this->roomTypeList($aux);
                    break;
                case 'roomQuantity':
                    $this->roomQuantityList($aux);
                    break;

                case 'enterprise':
                    $this->enterpriseList();
                    break;

                case 'country':
                    $this->countryList();
                    break;

                case 'profession':
                    $this->professionList();
                    break;

                case 'city':
                    $this->cityList($aux);
                break;

                case 'tariff':
                    $this->tariffList($aux,$aux2);
                    break;
            }
        }

        public function getTable($entity, $aux){
            switch ($entity) {
                case 'room':
                    $this->roomTable($aux);
                break;

                case 'enterprise':
                    $this->enterpriseTable();
                break;

                case 'rol':
                    $this->userComboRol();
                break;

                case 'type_document':
                    $this->typeDocument();
                break;

                case 'customers':
                    $this->customerTable();
                    break;

                case 'reservation':
                    $this->reservationTable();
                    break;
            }
        }

        function cityList($country){
            $query = $this->connect()->prepare('SELECT id_lugar,nombre_lugar 
                FROM lugares 
                WHERE tipo_lugar="C" AND id_ubicacion=:country ORDER BY nombre_lugar');
            $query->execute(['country'=>$country]);

            foreach ($query as $current) {
                echo '<option value="'.$current['id_lugar'].'">'.$current['nombre_lugar'].'</option>';
            }
        }

        public function countryList(){
            $query = $this->connect()->prepare('SELECT id_lugar,nombre_lugar 
                FROM lugares 
                WHERE tipo_lugar="P"');
            $query->execute();

            foreach ($query as $current) {
                echo '<option value="'.$current['id_lugar'].'">'.$current['nombre_lugar'].'</option>';
            }
        }
        public function professionList(){
            $query = $this->connect()->prepare('SELECT id_profesion,nombre_profesion FROM profesiones');
            $query->execute();

            foreach ($query as $current) {
                echo '<option value="'.$current['id_profesion'].'">'.$current['nombre_profesion'].'</option>';
            }
        }

        function enterpriseList(){
            $query = $this->connect()->prepare('SELECT id_empresa,nombre_empresa FROM empresas');
            $query->execute();

            foreach ($query as $current) {
                echo '<option value="'.$current['id_empresa'].'">'.$current['nombre_empresa'].'</option>';
            }
        }

        public function roomTypeList($type,$startDate,$finishDate){
            $query = $this->connect()->prepare('SELECT id_habitacion,numero_habitacion 
                FROM habitaciones h 
                INNER JOIN tipos_habitacion th ON h.id_tipo_habitacion=th.id_tipo_habitacion
                WHERE th.id_tipo_habitacion=:type
                AND id_habitacion NOT IN (
                SELECT id_habitacion
                FROM registros_habitacion rh 
                INNER JOIN reservas r ON rh.id_reserva=r.id_reserva 
                WHERE (date_format(r.fecha_ingreso,"%X-%m-%d")='.$startDate.'
                OR (date_format(r.fecha_ingreso,"%X-%m-%d")>'.$startDate.' AND date_format(r.fecha_ingreso,"%X-%m-%d")='.$finishDate.')
                OR (date_format(r.fecha_salida,"%X-%m-%d")>'.$startDate.' AND date_format(r.fecha_salida,"%X-%m-%d")='.$finishDate.')
                OR (date_format(r.fecha_ingreso,"%X-%m-%d")>'.$startDate.' AND date_format(r.fecha_salida,"%X-%m-%d")='.$finishDate.')
                ) AND (r.estado_reserva="AC" OR r.estado_reserva="RE"))');


            $query->execute([':type'=>$type]);

            foreach ($query as $current) {
                echo '<option value="'.$current['id_habitacion'].'">'.$current['numero_habitacion'].'</option>';
            }
            return false;
        }

        public function roomQuantityList($quantity,$startDate,$finishDate){
            $query = $this->connect()->prepare('SELECT DISTINCT th.id_tipo_habitacion,th.nombre_tipo_habitacion
                FROM tipos_habitacion th 
                INNER JOIN tarifas t ON t.id_tipo_habitacion=th.id_tipo_habitacion
                INNER JOIN habitaciones h ON h.id_tipo_habitacion=th.id_tipo_habitacion
                WHERE t.cantidad_huespedes=:quantity 
                AND h.numero_habitacion NOT IN (
                SELECT numero_habitacion
                FROM habitaciones h
                INNER JOIN registros_habitacion rh ON rh.id_habitacion=h.id_habitacion 
                INNER JOIN reservas r ON rh.id_reserva=r.id_reserva 
                WHERE (date_format(r.fecha_ingreso,"%X-%m-%d")='.$startDate.'
                OR (date_format(r.fecha_ingreso,"%X-%m-%d")>'.$startDate.' AND date_format(r.fecha_ingreso,"%X-%m-%d")='.$finishDate.')
                OR (date_format(r.fecha_salida,"%X-%m-%d")>'.$startDate.' AND date_format(r.fecha_salida,"%X-%m-%d")='.$finishDate.')
                OR (date_format(r.fecha_ingreso,"%X-%m-%d")>'.$startDate.' AND date_format(r.fecha_salida,"%X-%m-%d")='.$finishDate.')
                ) AND (r.estado_reserva="AC" OR r.estado_reserva="RE"))
                ORDER BY th.id_tipo_habitacion');

            $query->execute([':quantity'=>$quantity]);
            echo $startDate.$finishDate;
            foreach ($query as $current) {
                echo '<option value="'.$current['id_tipo_habitacion'].'">'.$current['nombre_tipo_habitacion'].'</option>';
            }
            return false;
        }

        public function tariffList($quantity,$roomType){
            $query = $this->connect()->prepare('SELECT id_tarifa,valor_ocupacion FROM tarifas WHERE cantidad_huespedes=:quantity AND id_tipo_habitacion=:roomType ORDER BY valor_ocupacion');
            $query->execute([':quantity'=>$quantity,':roomType'=>$roomType]);

            foreach ($query as $current) {
                echo '<option value="'.$current['id_tarifa'].'">'.$this->setFormatPrice($current['valor_ocupacion']).'</option>';
            }
            echo "<option value='O'>Otro</option>";
            return false;
        }
        
        public function setFormatPrice($price){
            $length=strlen($price);
            $blocks=round($length/3);
            $rest=($length%3)==0?3:$length%3;
            $newValue="";
            
            for($i=0;$i<$blocks-1;$i++){
                $newValue=$newValue.'.'.substr($price,$length-3);
                $price=substr($price,0,$length-3);
            }
            $newValue=substr($price,0,$rest).$newValue;
            
            return $newValue;
        }


        function reservationTable(){
            $query = $this->connect()->prepare('SELECT r.id_reserva,c.id_persona, CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona) nombre_c,r.id_empresa, e.nombre_empresa, c.telefono_persona, c.correo_persona, date_format(r.fecha_ingreso,"%X-%m-%d") fecha_ingreso, TIMESTAMPDIFF(DAY, date_format(r.fecha_ingreso,"%X-%m-%d"),date_format(r.fecha_salida,"%X-%m-%d")) dias, NVL2(tipo_documento,0,1) aux 
                FROM reservas r 
                LEFT JOIN personas c ON r.id_titular=c.id_persona 
                LEFT JOIN empresas e ON r.id_empresa=e.id_empresa 
                WHERE r.estado_reserva="AC"');
            $query->execute();

            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['id_reserva'].'</td>'.PHP_EOL;
                echo '<td><button onclick="window.location.href='."'/reservas/editar?id=".$current['id_reserva']."'".'" class="btn btn-table btn-edit-hover '.($current['aux']==0?"btn-success":"btn-complete").'"><span>'.($current['aux']==0?"Listo":"Completar").'</span></button></td>'.PHP_EOL;
                echo '<td><label class="switch switch-table"><input type="checkbox" onchange="setCheckOn('.$current['id_reserva'].',this);"'.($current['aux']==1?'disabled':'').'><span class="slider '.($current['aux']==1?'slider-gray':'slider-red').' round green"></span></label></td>';
                echo '<td><a href="/clientes/detalles?id='.$current['id_persona'].'">'.$current['nombre_c'].'</a></td>'.PHP_EOL;
                echo '<td>'.$current['telefono_persona'].'</td>'.PHP_EOL;
                echo '<td>'.($current['fecha_ingreso']>=date("Y-m-d")?$current['fecha_ingreso']:"Vencido").'</td>'.PHP_EOL;
                echo '<td>'.$current['dias'].'</td>'.PHP_EOL;
                echo '<td><a href="/empresas/detalles?id='.$current['id_empresa'].'">'.$current['nombre_empresa'].'</a></td>'.PHP_EOL;
                echo '<td>'.$current['correo_persona'].'</td>'.PHP_EOL;
                echo '</tr>'.PHP_EOL;
            }
        }

       
        function enterpriseCustomTable($idEnterprise){
            $query = $this->connect()->prepare('SELECT CONCAT(nombres_persona, " ", apellidos_persona) AS nombres, numero_documento, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fecha_ingreso, DATE_FORMAT(fecha_salida, "%d/%m/%Y") AS fecha_salida, valor_total FROM personas p 
                LEFT JOIN reservas r ON r.id_cliente = p.id_persona 
                LEFT JOIN empresas e ON r.id_empresa = e.id_empresa 
                LEFT JOIN facturas f ON f.id_reserva = r.id_reserva 
                WHERE e.id_empresa = :idEnterprise');
            $query->execute(['idEnterprise'=>$idEnterprise]);
            
            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['nombres'].'</td>'.PHP_EOL;
                echo '<td>'.$current['numero_documento'].'</td>'.PHP_EOL;
                echo '<td>'.$current['fecha_ingreso'].'</td>'.PHP_EOL;
                echo '<td>'.$current['fecha_salida'].'</td>'.PHP_EOL;
                echo '<td>'.$current['valor_total'].'</td>'.PHP_EOL;
            }                              
        }
        
        function customerTable(){
            $query = $this->connect()->prepare('SELECT id_persona, CONCAT_WS(" ", nombres_persona, apellidos_persona) AS nombre, tipo_documento, numero_documento, nombre_profesion, telefono_persona, correo_persona 
                FROM personas p 
                LEFT JOIN profesiones pr ON p.id_profesion=pr.id_profesion 
                WHERE tipo_persona = "C"');
            $query->execute();

            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td><a href="/clientes/detalles?id='.$current['id_persona'].'">'.$current['nombre'].'</a></td>'.PHP_EOL;
                echo '<td class="num">'.$current['numero_documento'].'</td>'.PHP_EOL;
                echo '<td>'.$current['telefono_persona'].'</td>'.PHP_EOL;
                echo '<td>'.$current['correo_persona'].'</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_profesion'].'</td>'.PHP_EOL;
                echo '<td><a href="detalles?id='.$current['id_persona'].'" id="button-update-client" class="col-10">Ver</a></td>'.PHP_EOL;
                echo '</tr>'.PHP_EOL;
            }
        }

        
        function enterpriseTable(){
            $query = $this->connect()->prepare('SELECT id_empresa,nit_empresa, nombre_empresa, telefono_empresa, retefuente, ica 
                FROM empresas');
            $query->execute();
            
            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['nit_empresa'].'</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_empresa'].'</td>'.PHP_EOL;
                echo '<td>'.$current['telefono_empresa'].'</td>'.PHP_EOL;
                echo '<td>'.($current['retefuente']==1?'Si':'No').'</td>';
                echo '<td>'.($current['ica']==1?'Si':'No').'</td>';
                echo '<td><a href="detalles?id='.$current['id_empresa'].'" class="button-more-info" class="col-10">Más información</a></td>';
                echo '</tr>'.PHP_EOL;
            }
        }

        function roomTable($date){
            $query= $this->connect()->prepare('SELECT h.id_habitacion, th.nombre_tipo_habitacion,h.numero_habitacion,h.fuera_de_servicio, CASE WHEN rg.estado_reserva="RE" THEN rg.nombres_clientes ELSE NULL END nombres_clientes,CASE WHEN rg.estado_reserva="RE" THEN rg.ids_clientes ELSE NULL END ids_clientes, CASE WHEN rg.estado_reserva="RE" THEN rg.fecha_ingreso ELSE NULL END fecha_ingreso, CASE WHEN rg.estado_reserva="RE" THEN rg.conteo ELSE NULL END conteo, rg.estado_reserva 
                FROM habitaciones h 
                LEFT JOIN (
                SELECT rs.id_habitacion,r.estado_reserva, GROUP_CONCAT(CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona)) nombres_clientes, GROUP_CONCAT(c.id_persona) ids_clientes, r.fecha_ingreso,CONCAT_WS(" de ",TIMESTAMPDIFF(DAY,date_format(r.fecha_ingreso,"%X-%m-%d"),"'.$date.'"),TIMESTAMPDIFF(DAY,date_format(r.fecha_ingreso,"%X-%m-%d"), r.fecha_salida)) conteo 
                FROM reservas r 
                INNER JOIN registros_habitacion rs ON rs.id_reserva=r.id_reserva 
                INNER JOIN registros_huesped rh ON rh.id_registro_habitacion=rs.id_registro_habitacion 
                INNER JOIN personas c ON rh.id_huesped=c.id_persona  
                WHERE date_format(r.fecha_ingreso,"%X-%m-%d")<="'.$date.'" 
                AND date_format(r.fecha_salida,"%X-%m-%d") >="'.$date.'" 
                AND (r.estado_reserva="RE" OR r.estado_reserva="AC") 
                GROUP BY id_habitacion) rg ON rg.id_habitacion=h.id_habitacion 
                LEFT JOIN tipos_habitacion th ON h.id_tipo_habitacion=th.id_tipo_habitacion');
            $query->execute();

            foreach ($query as $current) {
                echo '<tr>'.PHP_EOL;
                echo '<td><p class="vertical-word">'.$current['nombre_tipo_habitacion'].'</p></td>'.PHP_EOL;
                echo '<td id="room-'.$current['numero_habitacion'].'" class="room-cell">'.$current['numero_habitacion'].'<br>'.PHP_EOL;
                echo '<p class="room-state">'.$this->roomState2($current['fuera_de_servicio'],$current['estado_reserva'],$date).'</p>'.PHP_EOL;
                //echo '<select id="state-'.$current['numero_habitacion'].'" class="room-state-change" onchange="changeColor('.$current['numero_habitacion'].');" disabled>'.PHP_EOL;
                //$this->chooseRoomState($current['estado_habitacion']);
                //echo '</select>'.PHP_EOL;
                echo '</td>'.PHP_EOL;
                echo '<td>';
                
                $names=explode(",",$current['nombres_clientes']);
                $ids=explode(",",$current['ids_clientes']);
                
                for ($i=0;$i<count($names);$i++) {
                    echo '<a href=/clientes/detalles?id='.$ids[$i].'>'.$names[$i].'</a>';
                    if(count($names)-1!=$i)
                        echo ',';
                }

                echo '</td>';
                echo '<td>'.$current['fecha_ingreso'].'</td>';
                echo '<td>'.$current['conteo'].'</td>';
                echo '<td>'.'</td>';
                echo '<td><label class="switch switch-table"><input type="checkbox"><span class="slider slider-gray round green"></span></label></td>';
                echo '<td><label class="switch switch-table"><input type="checkbox"><span class="slider slider-gray round yellow"></span></label></td>';
                echo '<td><a href="detalles?id='.$current['id_habitacion'].'" class="col-10 button-more-info">Más información</a></td>';
                echo '</tr>'.PHP_EOL;
            }
        }

        function userComboRol(){
            $query = $this->connect()->prepare('SELECT nombre_cargo FROM cargos');
            $query->execute();
            
            foreach($query as $current){
                echo '<option value = "'.$current['nombre_cargo'].'">'.$current['nombre_cargo'].'</option>'.PHP_EOL;
            }
        }
        
        function typeDocument(){
            $query = $this->connect()->prepare('SELECT nombre_tipo FROM tipos_documento');
            $query->execute();
            
            foreach($query as $current){
                echo '<option value = "'.$current['nombre_tipo'].'">'.$current['nombre_tipo'].'</option>'.PHP_EOL;
            }
        }

        function getRemainingProfession($currentProfession){
            $query = $this->connect()->prepare('SELECT id_profesion, nombre_profesion FROM profesiones');
            $query->execute();

            foreach ($query as $current) {
                if($current['nombre_profesion']!=$currentProfession)
                    echo '<option value="'.$current['id_profesion'].'">'.$current['nombre_profesion'].'</option>'; 
            }
        }
        
        function getRemainingExp($currentExp){
            $query = $this->connect()->prepare('SELECT id_lugar, nombre_lugar FROM lugares WHERE tipo_lugar="C" ORDER BY 2');
            $query->execute();

            foreach ($query as $current) {
                if($current['nombre_lugar']!=$currentExp)
                echo '<option value="'.$current['id_lugar'].'">'.$current['nombre_lugar'].'</option>';
            }
        }
        
        function getRemainingNac($currentNac){
            $query = $this->connect()->prepare('SELECT id_lugar, nombre_lugar FROM lugares WHERE tipo_lugar="P" ORDER BY 2');
            $query->execute();

            foreach ($query as $current) {
                if($current['nombre_lugar']!=$currentNac)
                echo '<option value="'.$current['id_lugar'].'">'.$current['nombre_lugar'].'</option>';
            }
        }
        
        function selectCheck($state){
            switch ($state){
                case 0:
                    return '';
                case 1:
                    return 'checked';
            }
        }

        function roomType($type){
            switch ($type) {
                case 'J':
                return 'JOLIOT';
                case 'H':
                return 'HAWKING';
                case 'L':
                return 'LISPECTOR';
                case 'M':
                return 'MAKKAH';
            }
        }

        function roomState($state){
            switch ($state) {
                case 'L':
                return 'Disponible';
                case 'O':
                return 'Ocupada';
                case 'R':
                return 'Con reserva';
                case 'X':
                return 'Fuera de servicio';
            }
        }

        function roomState2($stateRoom, $stateBook,$date){
            if($stateRoom==0)
                if($stateBook=="RE")
                    return 'Ocupada';
                else if($stateBook=="AC"){
                    if(date("Y-m-d")==$date)
                        return 'Con reserva';
                    else
                        return 'Disponible';
                }else 
                    return 'Disponible';
            else
                return 'Fuera de servicio';
        }

        function chooseRoomState($state){
            switch ($state) {
                case 'L':
                    echo '<option value="L">Disponible</option>'.PHP_EOL;
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="R">Con reserva</option>'.PHP_EOL;
                    echo '<option value="X">Fuera de servicio</option>'.PHP_EOL;
                    break;
                case 'O':
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="L">Disponible</option>'.PHP_EOL;
                    echo '<option value="R">Con reserva</option>'.PHP_EOL;
                    echo '<option value="X">Fuera de servicio</option>'.PHP_EOL;
                    break;
                case 'R':
                    echo '<option value="R">Con reserva</option>'.PHP_EOL;
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="L">Disponible</option>'.PHP_EOL;
                    echo '<option value="X">Fuera de servicio</option>'.PHP_EOL;
                    break;
                case 'X':
                    echo '<option value="X">Fuera de servicio</option>'.PHP_EOL;
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="L">Disponible</option>'.PHP_EOL;
                    echo '<option value="R">Con reserva</option>'.PHP_EOL;
                    break;
            }
            
        }

        public function getPerson($id){
            $query = $this->connect()->prepare('SELECT id_persona,id_lugar_nacimiento,id_lugar_expedicion,id_profesion,id_cargo,nombres_persona,apellidos_persona,tipo_documento,genero_persona,fecha_nacimiento,tipo_sangre_rh,telefono_persona,correo_persona  FROM personas p  WHERE tipo_persona = "C" AND numero_documento=:idPerson');
            $query->execute([':idPerson'=>$id]);

            foreach ($query as $current){
                echo $current['id_persona'].';';
                echo $current['id_lugar_nacimiento'].';';
                echo $current['id_lugar_expedicion'].';';
                echo $current['id_profesion'].';';
                echo $current['nombres_persona'].';';
                echo $current['apellidos_persona'].';';
                echo $current['tipo_documento'].';';
                echo $current['genero_persona'].';';
                echo $current['fecha_nacimiento'].';';
                echo $current['tipo_sangre_rh'].';';
                echo $current['telefono_persona'].';';
                echo $current['correo_persona'];
            }
        }

        public function getBooking($id){
            $query = $this->connect()->prepare('SELECT date_format(r.fecha_ingreso,"%X-%m-%d") fecha_ingreso, 
                date_format(r.fecha_salida,"%X-%m-%d") fecha_salida, 
                COUNT(rh.id_registro_habitacion) cantidad_habitaciones,
                COUNT(rc.id_registro_huesped) cantidad_huespedes,
                h.id_habitacion,h.id_tipo_habitacion
                c.id_persona,c.nombres_persona,c.apellidos_persona,c.tipo_documento,c.numero_documento,c.id_lugar_expedicion,
                c.id_lugar_nacimiento,c.telefono_persona,c.correo_persona,c.genero_persona,c.fecha_nacimiento,c.tipo_sangre_rh,c.id_profesion
                FROM reservas r 
                INNER JOIN registros_habitacion rh ON rh.id_reserva=r.id_reserva
                inner JOIN habitaciones h ON rh.id_habitacion=h.id_habitacion
                INNER JOIN registros_huesped rc ON rc.id_registro_habitacion=rh.id_registro_habitacion
                INNER JOIN personas c ON rc.id_huesped=c.id_persona
                WHERE r.id_reserva=:id
                GROUP BY fecha_ingreso,fecha_salida,id_huesped');

            $query->execute([':id'=>$id]);

            foreach ($query as $current) {
                echo $current['fecha_ingreso'].';';
                echo $current['fecha_salida'].';';
                echo $current['cantidad_habitaciones'].';';
                echo $current['cantidad_huespedes'].';';
                echo $current['id_persona'].';';
                echo $current['id_lugar_nacimiento'].';';
                echo $current['id_lugar_expedicion'].';';
                echo $current['id_profesion'].';';
                echo $current['nombres_persona'].';';
                echo $current['apellidos_persona'].';';
                echo $current['tipo_documento'].';';
                echo $current['genero_persona'].';';
                echo $current['fecha_nacimiento'].';';
                echo $current['tipo_sangre_rh'].';';
                echo $current['telefono_persona'].';';
                echo $current['correo_persona'].'?';
            }
        }
    }