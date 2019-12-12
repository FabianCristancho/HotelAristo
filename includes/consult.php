<?php
   include_once '../includes/database.php';
    
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

        public function getTable($entity){
            switch ($entity) {
                case 'room':
                    $this->roomTable();
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
            }
        }

        function enterpriseList(){
            $query = $this->connect()->prepare('SELECT id_empresa,nombre_empresa FROM empresas');
            $query->execute();
            foreach ($query as $current) {
                echo '<option value="'.$current['id_empresa'].'">'.$current['nombre_empresa'].'</option>';
            }
        }
        
        function customerTable(){
            $query = $this->connect()->prepare('SELECT id_persona, CONCAT_WS(" ", nombres_persona, apellidos_persona) AS nombre, tipo_documento, numero_documento, nombre_lugar, nombre_profesion, CASE genero_persona WHEN "M" THEN "Hombre" WHEN "F" THEN "Mujer" ELSE "OTRO" END genero, fecha_nacimiento, tipo_sangre_rh, telefono_persona, correo_persona FROM personas p, profesiones pr, lugares l WHERE p.id_profesion=pr.id_profesion AND id_lugar_expedicion = id_lugar AND tipo_persona = "C"');
            $query->execute();
            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['nombre'].'</td>'.PHP_EOL;
                echo '<td>'.$current['tipo_documento'].'</td>'.PHP_EOL;
                echo '<td class="num">'.$current['numero_documento'].'</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_lugar'].'</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_profesion'].'</td>'.PHP_EOL;
                echo '<td>'.$current['genero'].'</td>'.PHP_EOL;
                echo '<td>'.$current['fecha_nacimiento'].'</td>'.PHP_EOL;
                echo '<td>'.$current['tipo_sangre_rh'].'</td>'.PHP_EOL;
                echo '<td>'.$current['telefono_persona'].'</td>'.PHP_EOL;
                echo '<td>'.$current['correo_persona'].'</td>'.PHP_EOL;
                echo '<td><a href="../edicion_cliente/?id='.$current['id_persona'].'" id="button-update-client" class="col-10">Editar información</a></td>'.PHP_EOL;
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
            $query = $this->connect()->prepare('SELECT nit_empresa, nombre_empresa, telefono_empresa, retefuente, otro_retefuente FROM empresas');
            $query->execute();
            
            foreach ($query as $current){
                echo '<tr>'.PHP_EOL;
                echo '<td>'.$current['nit_empresa'].'</td>'.PHP_EOL;
                echo '<td>'.$current['nombre_empresa'].'</td>'.PHP_EOL;
                echo '<td>'.$current['telefono_empresa'].'</td>'.PHP_EOL;
                echo '<td><input type="checkbox" '.$this->selectCheck($current['retefuente']).'></td>'.PHP_EOL;
                echo '<td><input type="checkbox" '.$this->selectCheck($current['otro_retefuente']).'></td>'.PHP_EOL;
                echo '<td><a href="" id="button-more-info" class="col-10">Más información</a></td>';
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

        function roomTable(){
            $query = $this->connect()->prepare('SELECT numero_habitacion, estado_habitacion, tipo_habitacion FROM habitaciones');
            $query->execute();

            foreach ($query as $current) {
                echo '<tr>'.PHP_EOL;
                echo '<td id="room-'.$current['numero_habitacion'].'" class="room-cell">'.$current['numero_habitacion'].'<br>'.PHP_EOL;
                echo '<p class="room-state">'.$this->roomState($current['estado_habitacion']).'</p>'.PHP_EOL;
                echo '<select id="state-'.$current['numero_habitacion'].'" class="room-state-change" onchange="changeColor('.$current['numero_habitacion'].');">'.PHP_EOL;
                echo '<option value="1">Ocupada</option>'.PHP_EOL;
                echo '<option value="2">Disponible</option>'.PHP_EOL;
                echo '<option value="3">Con reserva</option>'.PHP_EOL;
                echo '<option value="4">Fuera de servicio</option>'.PHP_EOL;
                echo '</select>'.PHP_EOL;
                echo '</td>'.PHP_EOL;
                echo '<td>'.$this->roomType($current['tipo_habitacion']).'</td>'.PHP_EOL;
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td><input type="checkbox"></td>';
                echo '<td><input type="checkbox"></td>';
                echo '<td><a href="" id="button-more-info" class="col-10">Más información</a></td>';
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
        
        function genericSelect($table, $getValue, $compare, $compareValue){
            $query = $this->connect()->prepare('SELECT '.$getValue.' FROM '.$table.' WHERE '.$compare.' = "'.$compareValue.'"');
            $query->execute();
            
            $result = '';
            foreach ($query as $current) {
                $result = $current[$getValue];
            }
            return $result;
        }
        
        function selectTypesDocument($typeDocument){
            $query = $this->connect()->prepare('SELECT CASE WHEN "'.$typeDocument.'" = "Cédula de ciudadanía" THEN "CC" WHEN "'.$typeDocument.'" = "Cédula de extranjería" THEN "CE" WHEN "'.$typeDocument.'" = "Registro civil" THEN "RC" WHEN "'.$typeDocument.'" = "Tarjeta de identidad" THEN "TI" END AS type');
            $query->execute();
            
            $result = '';
            foreach ($query as $current) {
                $result = $current['type'];
            }
            return $result;
        }
        
        function selectGender($gender){
            $query = $this->connect()->prepare('SELECT CASE WHEN UPPER("'.$gender.'") = "MUJER" THEN "F" WHEN UPPER("'.$gender.'") = "HOMBRE" THEN "M" END AS gender');
            $query->execute();
            
            $result = '';
            foreach ($query as $current) {
                $result = $current['gender'];
            }
            return $result;
        }
        
        
        function updateDataCustomers($id, $placeExp, $name, $lastName, $typeDoc, $numberDoc, $gender, $birthDate, $typeBlood, $rh, $phone, $email, $profession){
            
            $sql = $this->connect()->prepare("UPDATE personas SET id_persona = $id, id_lugar_expedicion = ". $this->genericSelect('lugares', 'id_lugar', 'nombre_lugar', $placeExp).", nombres_persona = '$name', apellidos_persona = '$lastName', tipo_documento = '".$this->selectTypesDocument($typeDoc)."', numero_documento = '$numberDoc', genero_persona = '".$this->selectGender($gender)."', tipo_sangre_rh = '$typeBlood$rh', telefono_persona = '$phone', correo_persona = '$email', id_profesion = ".$this->genericSelect('profesiones', 'id_profesion', 'nombre_profesion', $profession)." WHERE id_persona = $id");
            
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>

