<?php
    include 'database.php';

    switch ($_POST['entity']) {
        case 'enterprise':
            getConsultEnterprise();
            break;
        case 'user':
            getConsultUser();
        break;
        case 'customer':
            getConsultCustomer();
        break;
        default:
            break;
    }

    function getConsultEnterprise(){
        $database = new Database();

        $idEnterprise = $_POST['id'];

        $output = "";
        $query = "SELECT id_empresa, nit_empresa, nombre_empresa, telefono_empresa, retefuente, ica FROM empresas ORDER BY nombre_empresa";

        if(!empty($idEnterprise)){
            $query = "SELECT id_empresa, nit_empresa, nombre_empresa, telefono_empresa, retefuente, ica FROM empresas WHERE nit_empresa LIKE '%$idEnterprise%' OR nombre_empresa LIKE '%$idEnterprise%' ORDER BY nombre_empresa"; 
        }

        $result = $database->connect()->prepare($query);
        $result->execute();

        if($result->rowCount()>0){
            $output.="<table>
            <thead>
                <tr>
                    <th>NIT</th>
                    <th>NOMBRE</th>
                    <th>TELEFONO</th>
                    <th>RETEFUENTE <br/>(3,5 %)</br></th>
                    <th>ICA</br></th>
                </tr>
            </thead>
            <tbody>";

            foreach ($result as $current) {
                $output.='<tr>
                            <td>'.$current['nit_empresa'].'</td>
                            <td style = "text-align: left; padding: 10px;"><a href="/empresas/detalles?id='.$current['id_empresa'].'">'.$current['nombre_empresa'].'</a></td>
                            <td>'.$current['telefono_empresa'].'</td>
                            <td>'.$current['retefuente'].'</td>
                            <td>'.$current['ica'].'</td>
                        </tr>';
            }
            $output.="</tbody></table>";
        }else{
            $output.="LA BÚSQUEDA NO COINCIDE CON NINGÚN REGISTRO DE LA BASE DE DATOS";
        }
        echo $output;
    }


    function getConsultUser(){
        $database = new Database();

        $idUser = $_POST['id'];

        $output = "";
        $query = "SELECT id_persona, CONCAT_WS(' ', nombres_persona, apellidos_persona) AS nombres, telefono_persona, correo_persona, nombre_cargo FROM personas p INNER JOIN cargos c ON p.id_cargo = c.id_cargo ORDER BY CONCAT_WS(nombres_persona, apellidos_persona)";

        if(!empty($idUser)){
            $query = "SELECT id_persona, CONCAT_WS(' ', nombres_persona, apellidos_persona) AS nombres, telefono_persona, correo_persona, nombre_cargo FROM personas p INNER JOIN cargos c ON p.id_cargo = c.id_cargo WHERE numero_documento LIKE '%$idUser%' OR nombres_persona LIKE '%$idUser%' OR apellidos_persona LIKE '%$idUser%' ORDER BY CONCAT_WS(nombres_persona, apellidos_persona)"; 
        }

        $result = $database->connect()->prepare($query);
        $result->execute();

        if($result->rowCount()>0){
            $output.="<table>
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>TELÉFONO</th>
                    <th>CORREO ELECTRÓNICO</th>
                    <th>CARGO</th>
                </tr>
            </thead>
            <tbody>";

            foreach ($result as $current) {
                $output.='<tr>
                            <td style = "text-align: left; padding: 10px;"><a href="/usuarios/detalles?id='.$current['id_persona'].'">'.$current['nombres'].'</a></td>
                            <td>'.$current['telefono_persona'].'</td>
                            <td>'.$current['correo_persona'].'</td>
                            <td>'.$current['nombre_cargo'].'</td>
                        </tr>';
            }
            $output.="</tbody></table>";
        }else{
            $output.="LA BÚSQUEDA NO COINCIDE CON NINGÚN REGISTRO DE LA BASE DE DATOS";
        }
        echo $output;
    }

    function getConsultCustomer(){
        $database = new Database();

        $idCustomer = $_POST['id'];

        $output = "";
        $query = "SELECT id_persona, numero_documento, CONCAT_WS(' ', nombres_persona, apellidos_persona) AS nombres, telefono_persona FROM personas ORDER BY CONCAT_WS(nombres_persona, apellidos_persona)";

        if(!empty($idCustomer)){
            $query = "SELECT id_persona, numero_documento, CONCAT_WS(' ', nombres_persona,apellidos_persona) AS nombres, telefono_persona FROM personas WHERE numero_documento LIKE '%$idCustomer%' OR nombres_persona LIKE '%$idCustomer%' OR apellidos_persona LIKE '%$idCustomer%' ORDER BY CONCAT_WS(nombres_persona, apellidos_persona)"; 
        }

        $result = $database->connect()->prepare($query);
        $result->execute();

        if($result->rowCount()>0){
            $output.="<table>
            <thead>
                <tr>
                    <th>NÚMERO DE DOCUMENTO</th>
                    <th>NOMBRE</th>
                    <th>TELÉFONO</th>
                </tr>
            </thead>
            <tbody>";

            foreach ($result as $current) {
                $output.='<tr>
                            <td>'.$current['numero_documento'].'</td>
                            <td style = "text-align: left; padding: 10px;"><a href="/clientes/detalles?id='.$current['id_persona'].'">'.$current['nombres'].'</a></td>
                            <td>'.$current['telefono_persona'].'</td>
                        </tr>';
            }
            $output.="</tbody></table>";
        }else{
            $output.="LA BÚSQUEDA NO COINCIDE CON NINGÚN REGISTRO DE LA BASE DE DATOS";
        }
        echo $output;
    }
?>