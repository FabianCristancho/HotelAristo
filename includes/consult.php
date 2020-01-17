<?php
    
    class Consult extends Database {
        public function getList($entity, $aux){
            switch ($entity) {
                case 'roomType':
                    $this->roomTypeList($aux);
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
            $query = $this->connect()->prepare('SELECT id_lugar,nombre_lugar FROM lugares WHERE tipo_lugar="C" AND id_ubicacion='.$country);
            $query->execute();
            foreach ($query as $current) {
                echo '<option value="'.$current['id_lugar'].'">'.$current['nombre_lugar'].'</option>';
            }
        }

        public function countryList(){
            $query = $this->connect()->prepare('SELECT id_lugar,nombre_lugar FROM lugares WHERE tipo_lugar="P"');
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

        function reservationTable(){
            $query = $this->connect()->prepare('SELECT r.id_reserva,c.id_persona, CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona) nombre_c,e.id_empresa, e.nombre_empresa, c.telefono_persona, c.correo_persona, r.fecha_ingreso, TIMESTAMPDIFF(DAY, r.fecha_ingreso,r.fecha_salida) dias, NVL2(tipo_documento,0,1) aux FROM reservas r LEFT JOIN personas c ON r.id_cliente=c.id_persona LEFT JOIN empresas e ON c.id_empresa=e.id_empresa WHERE r.estado_reserva="AC"');
            $query->execute();
            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['id_reserva'].'</td>'.PHP_EOL;
                echo '<td><button onclick="window.location.href='."'/reservas/editar?id=".$current['id_reserva']."'".'" class="btn btn-table '.($current['aux']==0?"btn-success":"btn-complete").'">'.($current['aux']==0?"Listo":"Completar").'</button></td>'.PHP_EOL;
                echo '<td><button onclick="" class="btn btn-table" '.($current['aux']==1?'disabled':'').'>'.($current['aux']==1?"Falta Check in":"Registrar").'</button></td>'.PHP_EOL;
                echo '<td><a href="/clientes/detalles?id='.$current['id_cliente'].'">'.$current['nombre_c'].'</a></td>'.PHP_EOL;
                echo '<td>'.$current['telefono_persona'].'</td>'.PHP_EOL;
                echo '<td>'.$current['fecha_ingreso'].'</td>'.PHP_EOL;
                echo '<td>'.$current['dias'].'</td>'.PHP_EOL;
                echo '<td><a href="/empresas/detalles?id='.$current['id_empresa'].'">'.$current['nombre_empresa'].'</a></td>'.PHP_EOL;
                echo '<td>'.$current['correo_persona'].'</td>'.PHP_EOL;
                echo '</tr>'.PHP_EOL;
            }
        }

       
        
        function customerTable(){
            $query = $this->connect()->prepare('SELECT id_persona, CONCAT_WS(" ", nombres_persona, apellidos_persona) AS nombre, tipo_documento, numero_documento, nombre_profesion, telefono_persona, correo_persona FROM personas p LEFT JOIN profesiones pr ON p.id_profesion=pr.id_profesion WHERE tipo_persona = "C"');
            $query->execute();
            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td><a href="/clientes/detalles?id='.$current['id_persona'].'">'.$current['nombre'].'</a></td>'.PHP_EOL;
                echo '<td class="num">'.$current['numero_documento'].'</td>'.PHP_EOL;
                echo '<td>'.$current['telefono_persona'].'</td>'.PHP_EOL;
                echo '<td>'.$current['correo_persona'].'</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_profesion'].'</td>'.PHP_EOL;
                echo '<td><a href="editar?id='.$current['id_persona'].'" id="button-update-client" class="col-10">Ver</a></td>'.PHP_EOL;
                echo '</tr>'.PHP_EOL;
            }
        }
        
        function roomTypeList($type){
            $query = $this->connect()->prepare('SELECT numero_habitacion FROM habitaciones WHERE tipo_habitacion='.'"'.$type.'"');
            $query->execute();
            foreach ($query as $current) {
                echo '<option value="'.$current['numero_habitacion'].'">'.$current['numero_habitacion'].'</option>';
            }
            return false;
        }
        
        function enterpriseTable(){
            $query = $this->connect()->prepare('SELECT id_empresa,nit_empresa, nombre_empresa, telefono_empresa, retefuente, otro_impuesto FROM empresas');
            $query->execute();
            
            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['nit_empresa'].'</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_empresa'].'</td>'.PHP_EOL;
                echo '<td>'.$current['telefono_empresa'].'</td>'.PHP_EOL;
                echo '<td><input type="checkbox" '.$this->selectCheck($current['retefuente']).'></td>'.PHP_EOL;
                echo '<td><input type="text" '.$current['otro_impuesto'].' disabled></td>'.PHP_EOL;
                echo '<td><a href="detalles?id='.$current['id_empresa'].'" class="button-more-info" class="col-10">Más información</a></td>';
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
        function roomTable($date){
            $qu= 'SELECT h.id_habitacion,numero_habitacion, estado_habitacion, tipo_habitacion, fecha_ingreso, CONCAT_WS(" de ",TIMESTAMPDIFF(DAY,rg.fecha_ingreso,"'.$date.'"),TIMESTAMPDIFF(DAY,rg.fecha_ingreso, rg.fecha_salida)) conteo,GROUP_CONCAT(CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona)) nombre_cliente,CONCAT_WS(" ",cx.nombres_persona,cx.apellidos_persona) nombre_cliente_aux FROM habitaciones h LEFT JOIN registros_habitacion rg ON rg.id_habitacion=h.id_habitacion LEFT JOIN reservas r ON rg.id_reserva=r.id_reserva LEFT JOIN personas c ON r.id_cliente=c.id_persona LEFT JOIN personas_auxiliares cx ON r.id_cliente_aux=cx.id_persona_aux AND fecha_ingreso <="'.$date.'" AND fecha_salida >="'.$date.'"';

            $query = $this->connect()->prepare('SELECT h.id_habitacion, h.tipo_habitacion,h.numero_habitacion,h.estado_habitacion, GROUP_CONCAT(CONCAT_WS(" ",c.nombres_persona,c.apellidos_persona)) nombre_cliente,r.fecha_ingreso,CONCAT_WS(" de ",TIMESTAMPDIFF(DAY,r.fecha_ingreso,"'.$date.'"),TIMESTAMPDIFF(DAY,r.fecha_ingreso, r.fecha_salida)) conteo FROM habitaciones h LEFT JOIN registros_habitacion rs ON rs.id_habitacion=h.id_habitacion LEFT JOIN personas c ON rs.id_cliente=c.id_persona LEFT JOIN reservas r ON rs.id_reserva=r.id_reserva GROUP BY h.id_habitacion');
            
            $query->execute();
            foreach ($query as $current) {
                echo '<tr>'.PHP_EOL;
                echo '<td><p class="vertical-word">'.$this->roomType($current['tipo_habitacion']).'</p></td>'.PHP_EOL;
                echo '<td id="room-'.$current['numero_habitacion'].'" class="room-cell">'.$current['numero_habitacion'].'<br>'.PHP_EOL;
                echo '<p class="room-state">'.$this->roomState($current['estado_habitacion']).'</p>'.PHP_EOL;
                echo '<select id="state-'.$current['numero_habitacion'].'" class="room-state-change" onchange="changeColor('.$current['numero_habitacion'].');" >'.PHP_EOL;
                $this->chooseRoomState($current['estado_habitacion']);
                echo '</select>'.PHP_EOL;
                echo '</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_cliente'].'</td>';
                echo '<td>'.$current['fecha_ingreso'].'</td>';
                echo '<td>'.$current['conteo'].'</td>';
                echo '<td>'.'</td>';
                echo '<td><input type="checkbox"></td>';
                echo '<td><input type="checkbox"></td>';
                echo '<td><a href="detalles?id='.$current['id_habitacion'].'" class="col-10 button-more-info">Más información</a></td>';
                echo '</tr>'.PHP_EOL;
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
        		case 'D':
        		return 'Disponible';
        		case 'O':
        		return 'Ocupada';
        		case 'R':
        		return 'En reserva';
        		case 'F':
        		return 'Fuera de servicio';
        	}
        }
        function chooseRoomState($state){
            switch ($state) {
                case 'D':
                    echo '<option value="D">Disponible</option>'.PHP_EOL;
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="M">Con reserva</option>'.PHP_EOL;
                    echo '<option value="F">Fuera de servicio</option>'.PHP_EOL;
                    break;
                case 'O':
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="D">Disponible</option>'.PHP_EOL;
                    echo '<option value="M">Con reserva</option>'.PHP_EOL;
                    echo '<option value="F">Fuera de servicio</option>'.PHP_EOL;
                    break;
                case 'M':
                    echo '<option value="M">Con reserva</option>'.PHP_EOL;
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="D">Disponible</option>'.PHP_EOL;
                    echo '<option value="F">Fuera de servicio</option>'.PHP_EOL;
                    break;
                case 'F':
                    echo '<option value="F">Fuera de servicio</option>'.PHP_EOL;
                    echo '<option value="O">Ocupada</option>'.PHP_EOL;
                    echo '<option value="D">Disponible</option>'.PHP_EOL;
                    echo '<option value="M">Con reserva</option>'.PHP_EOL;
                    break;
            }
            
        }
    }
?>