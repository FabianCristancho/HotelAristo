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
        case 'bill':
            getConsultBill();
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

    function getConsultBill(){
        $database = new Database();

        $idBill = $_POST['id'];

        $output = "";
        $query = "SELECT id_factura, serie_factura, r.id_reserva, CASE WHEN r.id_titular IS NOT NULL THEN CONCAT_WS(' ',pt.nombres_persona, pt.apellidos_persona) ELSE e.nombre_empresa END AS titular, CONCAT_WS(' ',pr.nombres_persona, pr.apellidos_persona) AS responsable, total_factura, DATE_FORMAT(fecha_factura, '%d/%m/%Y') AS fecha_factura, CASE WHEN f.tipo_factura='N' THEN 0 ELSE 1 END AS tipo
        FROM facturas f INNER JOIN reservas r ON f.id_reserva=r.id_reserva
        LEFT JOIN personas pr ON f.id_responsable = pr.id_persona
        LEFT JOIN personas pt ON r.id_titular=pt.id_persona
        LEFT JOIN empresas e ON r.id_empresa=e.id_empresa
        WHERE tipo_factura = 'N'
        ORDER by f.fecha_factura, f.serie_factura";

        if(!empty($idBill)){
            $query = "SELECT id_factura, serie_factura, r.id_reserva, CASE WHEN r.id_titular IS NOT NULL THEN CONCAT_WS(' ',pt.nombres_persona, pt.apellidos_persona) ELSE e.nombre_empresa END AS titular, CONCAT_WS(' ',pr.nombres_persona, pr.apellidos_persona) AS responsable, total_factura, DATE_FORMAT(fecha_factura, '%d/%m/%Y') AS fecha_factura, CASE WHEN f.tipo_factura='N' THEN 0 ELSE 1 END AS tipo
            FROM facturas f INNER JOIN reservas r ON f.id_reserva=r.id_reserva
            LEFT JOIN personas pr ON f.id_responsable = pr.id_persona
            LEFT JOIN personas pt ON r.id_titular=pt.id_persona
            LEFT JOIN empresas e ON r.id_empresa=e.id_empresa
            WHERE tipo_factura = 'N'
            AND serie_factura LIKE '%$idBill%' OR CONCAT_WS(' ', pt.nombres_persona, pt.apellidos_persona) LIKE '%$idBill%' OR e.nombre_empresa LIKE '%$idBill%'
            ORDER by f.fecha_factura, f.serie_factura"; 
        }

        $result = $database->connect()->prepare($query);
        $result->execute();

        if($result->rowCount()>0){
            $output.="<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITULAR</th>
                    <th>VALOR FACTURADO($)</th>
                    <th>FECHA DE FACTURACIÓN </th>
                    <th>RESPONSABLE</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

            foreach ($result as $current) {
                $output.='<tr>
                            <td>'.$current['serie_factura'].'</td>
                            <td>'.$current['titular'].'</td>
                            <td>'.'$ '.number_format($current['total_factura'], 0, '.', '.').'</td>
                            <td>'.$current['fecha_factura'].'</td>
                            <td>'.$current['responsable'].'</td>
                            <td><a href = "/facturas/registrar?id='.$current['id_reserva'].'&serie='.$current['serie_factura'].'"class="button-more-info" class="col-10">Ver Detalles</a></td>
                            <td><a href = "/reportes/facturas?id='.$current['id_reserva'].'&typeBill='.$current['tipo'].'&serie='.$current['serie_factura'].'" class="col-10"><img src="/res/img/pdf-icon.png" style="cursor:pointer;" width="60"/></a></td>
                        </tr>';
            }
            $output.="</tbody></table>";
        }else{
            $output.="LA BÚSQUEDA NO COINCIDE CON NINGÚN REGISTRO DE LA BASE DE DATOS";
        }
        echo $output;
    }


?>