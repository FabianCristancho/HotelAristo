<?php
    include 'database.php';

    switch ($_POST['entity']) {
        case 'enterprise':
            getConsultEnterprise();
            break;
        case 'user':
            getConsultUser();
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
            $output.="NO HAY DATOS";
        }
        echo $output;
    }


    function getConsultUser(){
        $database = new Database();

        $idUser = $_POST['id'];

        $output = "";
        $query = "SELECT id_persona, nombres_persona, telefono_persona, correo_persona, nombre_cargo FROM personas p INNER JOIN cargos c ON p.id_cargo = c.id_cargo ORDER BY nombres_persona";

        if(!empty($idUser)){
            $query = "SELECT id_persona, nombres_persona, telefono_persona, correo_persona, nombre_cargo FROM personas p INNER JOIN cargos c ON p.id_cargo = c.id_cargo WHERE numero_documento LIKE '%$idUser%' OR nombres_persona LIKE '%$idUser%' ORDER BY nombres_persona"; 
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
                            <td style = "text-align: left; padding: 10px;"><a href="/usuarios/detalles?id='.$current['id_persona'].'">'.$current['nombres_persona'].'</a></td>
                            <td>'.$current['telefono_persona'].'</td>
                            <td>'.$current['correo_persona'].'</td>
                            <td>'.$current['nombre_cargo'].'</td>
                        </tr>';
            }
            $output.="</tbody></table>";
        }else{
            $output.="NO HAY DATOS";
        }
        echo $output;
    }
?>