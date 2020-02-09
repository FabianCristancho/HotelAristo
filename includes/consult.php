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

        public function getProductList(){
             $query = $this->connect()->prepare('SELECT id_producto,nombre_producto, valor_producto
                FROM productos');
            $query->execute();

            foreach ($query as $current) {
                echo '<option value="'.$current['id_producto'].'">'.$current['nombre_producto'].' ('.$current['valor_producto'].') '.'</option>';
            }
        }

        public function getServiceList(){
             $query = $this->connect()->prepare('SELECT id_servicio,nombre_servicio, valor_servicio
                FROM servicios');
            $query->execute();

            foreach ($query as $current) {
                echo '<option value="'.$current['id_servicio'].'">'.$current['nombre_servicio'].' ('.$current['valor_servicio'].') '.'</option>';
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
            $query = $this->connect()->prepare('SELECT r.id_reserva,
                date_format(r.fecha_ingreso,"%X-%m-%d") fecha_ingreso, 
                TIMESTAMPDIFF(DAY, date_format(r.fecha_ingreso,"%X-%m-%d"),date_format(r.fecha_salida,"%X-%m-%d")) dias, 
                r.id_titular, CONCAT_WS(" ",t.nombres_persona,t.apellidos_persona) nombre_t,t.telefono_persona, 
                r.id_empresa, e.nombre_empresa, e.telefono_empresa,
                rc.id_huesped, GROUP_CONCAT(CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona)) nombres_c,GROUP_CONCAT(c.id_persona) ids_c,
                COUNT(rc.id_registro_huesped)=COUNT(NVL2(c.tipo_documento,0,1)) aux
                FROM reservas r 
                LEFT JOIN personas t ON r.id_titular=t.id_persona 
                LEFT JOIN empresas e ON r.id_empresa=e.id_empresa 
                LEFT JOIN registros_habitacion rh ON rh.id_reserva=r.id_reserva
                LEFT JOIN registros_huesped rc ON rc.id_registro_habitacion=rh.id_registro_habitacion
                LEFT JOIN personas c ON rc.id_huesped=c.id_persona
                WHERE r.estado_reserva="AC"
                GROUP BY r.id_reserva');
            $query->execute();

            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['id_reserva'].'</td>'.PHP_EOL;
                echo '<td><button onclick="window.location.href='."'/reservas/editar?id=".$current['id_reserva']."'".'" class="btn btn-table btn-edit-hover '.($current['aux']==1?"btn-success":"btn-complete").'"><span>'.($current['aux']==1?"Listo":"Completar").'</span></button></td>'.PHP_EOL;
                echo '<td><label class="switch switch-table"><input type="checkbox" onchange="setCheckOn('.$current['id_reserva'].',this);"'.($current['aux']==0?'disabled':'').'><span class="slider '.($current['aux']==0?'slider-gray':'slider-red').' round green"></span></label></td>';
                echo '<td><a href="'.($current['id_titular']==""?'/empresas/detalles?id='.$current['id_empresa']:'/clientes/detalles?id='.$current['id_titular']).'">'.($current['id_titular']==""?$current['nombre_empresa']:$current['nombre_t']).'</a></td>';
                echo '<td>'.($current['id_titular']==""?$current['telefono_empresa']:$current['telefono_persona']).'</td>'.PHP_EOL;
                echo '<td>'.($current['fecha_ingreso']>=date("Y-m-d")?$current['fecha_ingreso']:"Vencido").'</td>'.PHP_EOL;
                echo '<td>'.$current['dias'].'</td>'.PHP_EOL;
                 echo '<td>';
                
                $names=explode(",",$current['nombres_c']);
                $ids=explode(",",$current['ids_c']);
                
                for ($i=0;$i<count($names);$i++) {
                    echo '<a href=/clientes/detalles?id='.$ids[$i].'>'.$names[$i].'</a>';
                    if(count($names)-1!=$i)
                        echo ',';
                }

                echo '</td>';
                echo '<td><a href="detalles?id='.$current['id_reserva'].'" class="button-more-info">Ver</a></td>'.PHP_EOL;
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
            $query= $this->connect()->prepare('SELECT h.id_habitacion, th.nombre_tipo_habitacion,h.numero_habitacion,h.fuera_de_servicio, CASE WHEN rg.estado_reserva="RE" THEN rg.nombres_clientes ELSE NULL END nombres_clientes,CASE WHEN rg.estado_reserva="RE" THEN rg.ids_clientes ELSE NULL END ids_clientes, CASE WHEN rg.estado_reserva="RE" THEN rg.fecha_ingreso ELSE NULL END fecha_ingreso, CASE WHEN rg.estado_reserva="RE" THEN rg.conteo ELSE NULL END conteo, rg.estado_reserva, rg.id_reserva
                FROM habitaciones h 
                LEFT JOIN (
                SELECT r.id_reserva, rs.id_habitacion,r.estado_reserva, GROUP_CONCAT(CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona)) nombres_clientes, GROUP_CONCAT(c.id_persona) ids_clientes, r.fecha_ingreso,CONCAT_WS(" de ",TIMESTAMPDIFF(DAY,date_format(r.fecha_ingreso,"%X-%m-%d"),"'.$date.'"),TIMESTAMPDIFF(DAY,date_format(r.fecha_ingreso,"%X-%m-%d"), r.fecha_salida)) conteo 
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
                echo '<p class="room-state">'.$this->roomState($current['fuera_de_servicio'],$current['estado_reserva'],$date).'</p>'.PHP_EOL;
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
                echo '<td><a href="detalles?id='.$current['id_habitacion'].'&res='.$current['id_reserva'].'" class="col-10 button-more-info">Más información</a></td>';
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

        function roomState($stateRoom, $stateBook,$date){
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

        public function getPerson($id){
            $consult='SELECT id_persona,id_lugar_nacimiento,id_lugar_expedicion,id_profesion,
            nombres_persona,apellidos_persona,tipo_documento,numero_documento,
            genero_persona,fecha_nacimiento,tipo_sangre_rh,telefono_persona,correo_persona  
            FROM personas p  
            WHERE tipo_persona = "C" AND (numero_documento='.$id.' OR id_persona='.$id.')';

            $query = $this->connect()->prepare($consult);
            $query->execute();

            foreach ($query as $current){
                echo $current['id_persona'].';';
                echo $current['id_lugar_nacimiento'].';';
                echo $current['id_lugar_expedicion'].';';
                echo $current['id_profesion'].';';
                echo $current['nombres_persona'].';';
                echo $current['apellidos_persona'].';';
                echo $current['tipo_documento'].';';
                echo $current['numero_documento'].';';
                echo $current['genero_persona'].';';
                echo $current['fecha_nacimiento'].';';
                echo $current['tipo_sangre_rh'].';';
                echo $current['telefono_persona'].';';
                echo $current['correo_persona'];
            }
        }

        public function getBooking($id){
            $query = $this->connect()->prepare('SELECT DISTINCT date_format(r.fecha_ingreso,"%X-%m-%d") fecha_ingreso, 
                date_format(r.fecha_salida,"%X-%m-%d") fecha_salida, 
                COUNT(rh.id_registro_habitacion) cantidad_habitaciones,
                r.id_titular, r.id_empresa
                FROM reservas r 
                INNER JOIN registros_habitacion rh ON rh.id_reserva=r.id_reserva
                WHERE r.id_reserva=:id
                GROUP BY fecha_ingreso');

            $query->execute([':id'=>$id]);

            foreach ($query as $current) {
                echo $current['fecha_ingreso'].';';
                echo $current['fecha_salida'].';';
                echo $current['cantidad_habitaciones'].';';
                echo $current['id_titular'].';';
                echo $current['id_empresa'];
            }
        }

        public function getBookingRooms($id){
            $query = $this->connect()->prepare('SELECT t.cantidad_huespedes, t.id_tipo_habitacion,rh.id_habitacion, rc.id_huesped, p.numero_documento,t.id_tarifa, GROUP_CONCAT(rc.id_huesped) ids_huespedes,GROUP_CONCAT(p.numero_documento) docs_huespedes,
                t.valor_ocupacion
                FROM registros_habitacion rh
                INNER JOIN tarifas t ON rh.id_tarifa=t.id_tarifa
                INNER JOIN registros_huesped rc ON rc.id_registro_habitacion=rh.id_registro_habitacion
                INNER JOIN personas p ON rc.id_huesped=p.id_persona
                WHERE rh.id_reserva=:id
                GROUP BY id_habitacion');

            $query->execute([':id'=>$id]);

            foreach ($query as $current) {
                echo $current['cantidad_huespedes'].';';
                echo $current['id_tipo_habitacion'].';';
                echo $current['id_habitacion'].';';
                echo $current['id_tarifa'].';';
                echo $current['ids_huespedes'].';';
                echo $current['docs_huespedes'].';';
                echo $current['valor_ocupacion'].'?';
            }
        }


        public function getBookingTable($id){
            $query = $this->connect()->prepare('SELECT numero_habitacion,p.id_persona, CONCAT_WS(" ",p.nombres_persona,p.apellidos_persona) nombre
                FROM registros_habitacion rh
                INNER JOIN habitaciones h ON rh.id_habitacion=h.id_habitacion
                INNER JOIN registros_huesped rc ON rc.id_registro_habitacion=rh.id_registro_habitacion
                INNER JOIN personas p ON rc.id_huesped=p.id_persona
                WHERE rh.id_reserva=:id');

            $query->execute([':id'=>$id]);

            foreach ($query as $current) {
                echo '<tr><td>'.$current['numero_habitacion'].'</td>';
               echo '<td><a href="'.$current['id_persona'].'">'.$current['nombre'].'</a></td>';
            }
        }

        public function getRoomTable($id,$res){
            $query = $this->connect()->prepare('SELECT p.id_persona, CONCAT_WS(" ",p.nombres_persona,p.apellidos_persona) nombre,
                p.numero_documento,p.telefono_persona
                FROM registros_habitacion rh
                INNER JOIN habitaciones h ON rh.id_habitacion=h.id_habitacion
                INNER JOIN registros_huesped rc ON rc.id_registro_habitacion=rh.id_registro_habitacion
                INNER JOIN personas p ON rc.id_huesped=p.id_persona
                WHERE rh.id_reserva=:res
                AND rh.id_habitacion=:id');

            $query->execute([':id'=>$id,':res'=>$res]);

            foreach ($query as $current) {
                echo '<tr><td><a href=/clientes/detalles?id='.$current['id_persona'].'>'.$current['nombre'].'</a></td>';
                echo '<td>'.$current['numero_documento'].'</td>';
                echo '<td>'.$current['telefono_persona'].'</td>';
                echo '<td><label class="switch switch-table"><input type="checkbox"><span class="slider slider-gray round green"></span></label></td></tr>';
            }
        }

      
        public function getTitular($id){
            $query = $this->connect()->prepare('SELECT nombres_persona, apellidos_persona, numero_documento, telefono_persona, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fecha_ingreso, DATE_FORMAT(fecha_salida, "%d/%m/%Y") AS fecha_salida, nombre_empresa, GROUP_CONCAT(DISTINCT(numero_habitacion) SEPARATOR ",") AS habitaciones, r.id_reserva
            FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
            LEFT JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            LEFT JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
            LEFT JOIN empresas e ON r.id_empresa=r.id_reserva
            WHERE numero_documento=:idPerson
            AND fecha_ingreso = (SELECT MAX(fecha_ingreso) 
                                 FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                                WHERE numero_documento=:idPerson2)');
            $query->execute([':idPerson'=>$id, ':idPerson2'=>$id]);

            foreach ($query as $current){
                echo $current['nombres_persona'].';';
                echo $current['apellidos_persona'].';';
                echo $current['numero_documento'].';';
                echo $current['telefono_persona'].';';
                echo $current['fecha_ingreso'].';';
                echo $current['fecha_salida'].';';
                echo $current['nombre_empresa'].';';
                echo $current['habitaciones'].';';
                echo $current['id_reserva'].';';
            }
            
             $query = $this->connect()->prepare('SELECT numero_habitacion, valor_ocupacion
                FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
                LEFT JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
                LEFT JOIN habitaciones h ON h.id_habitacion=rh.id_habitacion
                LEFT JOIN tarifas tf ON tf.id_tarifa=rh.id_tarifa
                WHERE numero_documento=:idPerson
                AND fecha_ingreso = (SELECT MAX(fecha_ingreso) 
                                     FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                                    WHERE numero_documento=:idPerson2);');
            $query->execute([':idPerson'=>$id, ':idPerson2'=>$id]);
            
            foreach ($query as $current){
                echo "HABITACIÓN ".$current['numero_habitacion'].';';
                echo '1;';
                echo number_format($current['valor_ocupacion'], 0, '.', '.').';';
                echo number_format($current['valor_ocupacion'], 0, '.', '.').';';
            }
            
            $query = $this->connect()->prepare('SELECT nombre_producto, cantidad_producto, valor_producto AS valor_unitario, (cantidad_producto*valor_producto) AS valor_total
            FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
            INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
            INNER JOIN peticiones pt ON cd.id_control=pt.id_control
            INNER JOIN productos pd ON pd.id_producto=pt.id_producto
            WHERE numero_documento=:idPerson
            AND fecha_ingreso= (SELECT MAX(fecha_ingreso) 
                                 FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                                WHERE numero_documento=:idPerson2)');
            $query->execute([':idPerson'=>$id, ':idPerson2'=>$id]);
            
            foreach ($query as $current){
                echo "PRODUCTO ".$current['nombre_producto'].';';
                echo $current['cantidad_producto'].';';
                echo number_format($current['valor_unitario'], 0, '.', '.').';';
                echo number_format($current['valor_total'], 0, '.', '.').';';
            }
            
            $query = $this->connect()->prepare('SELECT nombre_servicio, valor_servicio
            FROM reservas r INNER JOIN personas p ON p.id_persona=r.id_titular
            INNER JOIN registros_habitacion rh ON r.id_reserva=rh.id_reserva
            INNER JOIN control_diario cd ON rh.id_registro_habitacion=cd.id_registro_habitacion
            INNER JOIN peticiones pt ON cd.id_control=pt.id_control
            INNER JOIN servicios s ON s.id_servicio=pt.id_servicio
            WHERE numero_documento=:idPerson
            AND fecha_ingreso= (SELECT MAX(fecha_ingreso) 
                                 FROM reservas r INNER JOIN personas p ON r.id_titular=p.id_persona
                                WHERE numero_documento=:idPerson2)');
            $query->execute([':idPerson'=>$id, ':idPerson2'=>$id]);
            
            foreach ($query as $current){
                echo "SERVICIO DE ".$current['nombre_servicio'].';';
                echo '1;';
                echo number_format($current['valor_servicio'], 0, '.', '.').';';
                echo number_format($current['valor_servicio'], 0, '.', '.').';';
            }
        }
        
        
        
        function getNextSerieOrder(){

            $query = $this->connect()->prepare('SELECT MAX(CAST(serie_factura AS INT)) AS last FROM facturas WHERE tipo_factura="O"');
            $query->execute();
            $serie;
            $code = "";
            
            foreach ($query as $current){
                $serie = $current['last'];
            }
            
            if($serie>=0&&$serie<=8){
                $serie = $serie+1;
                $code = "00".$serie;
            }else if($serie>=9&&$serie<=98){
                $serie = $serie+1;
                $code = "0".$serie;
            }else if($serie>=98 && $serie<=998){
                $serie = $serie+1;
                $code = $serie;
            }else{
                $code = "000";
            }
            
            return $code;
        }
        
        
        
        function getNextSerieBill(){
            
            $letter=65;
            
            $query = $this->connect()->prepare('SELECT MAX(ASCII(LEFT(serie_factura,1))) AS max FROM facturas WHERE tipo_factura="N"');
            $query->execute();
            
            foreach ($query as $current){
                $letter = $current['max'];
            }
            
            if($letter==""){
                $letter = 65;
            }
            
            $num=0;
            $query = $this->connect()->prepare('SELECT MAX(CAST(SUBSTRING(serie_factura,2) AS INT)) AS lastNum FROM facturas WHERE ASCII(LEFT(serie_factura,1))=:letter');
            $query->execute([':letter'=>$letter]);
            
            foreach ($query as $current){
                $num = $current['lastNum'];
            }
            
            
            $code = "";
            if($num>=0 && $num<=8){
                $num = $num+1;
                $code = chr($letter)."00".$num;
            }else if($num>=9 && $num<=98){
                $num = $num+1;
                $code = chr($letter)."0".$num;
            }else if($num>=98 && $num<=998){
                $num = $num+1;
                $code = chr($letter).$num;
            }else{
                
                if($num=999){
                    $letter = $letter+1;
                    $code = chr($letter)."000";
                }else{
                    $code = "A000";
                    
                }
            }
            return $code; 
        }
    }

?>
