<!DOCTYPE html>
<html>
    <head>
        <title>Detalles de Empresa | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
    </head>

    <body onload ="getDate('control-date',0);">
        <?php 
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../../objects/menu.php"; 
        ?>

        <script type="text/javascript">
            setCurrentPage("consultar");
        </script>


        <div id="content" class="col-12">
            <div class="marco nearly-page">
                <h4>INFORMACIÓN GENERAL</h4>
                <div class="general-info">
                    <div class="region">
                        <label><b>NIT: &ensp;</b></label>
                        <label>811.028.650-1</label>
                    </div>
                    <div class="region">
                        <label><b>Nombre: &ensp;</b></label>
                        <label>MADECENTRO COLOMBIA SAS</label>
                    </div>
                    <div class="region">
                        <label><b>Teléfono: &ensp;</b></label>
                        <label>7603323</label>
                    </div>
                    <div class="region">
                        <label><b>Retefuente (3,5%): &ensp; </b></label>
                        <label>No</label>
                    </div>
                    <div class="region">
                        <label><b>Otro impuesto: &ensp;</b></label>
                        <label>No</label>
                    </div>
                </div>
            </div>
            <div class="marco nearly-page">
                <div class="specific-info">
                    <div>
                        <h4><b>HUÉSPEDES AUTORIZADOS POR LA EMPRESA</b></h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Número de Documento</th>
                                    <th>Fecha de check-in</th>
                                    <th>Fecha de check-out</th>
                                    <th>Consumo Total ($)</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Giacomo Guilizzoni</td>
                                <td>1034543</td>
                                <td>03/11/2019</td>
                                <td>07/11/2019</td>
                                <td>124.745</td>
                            </tr>
                            <tr>
                                <td>Pedro Hernandez</td>
                                <td>1054433</td>
                                <td>10/11/2019</td>
                                <td>14/11/2019</td>
                                <td>324.000</td>
                            </tr>
                            <tr>
                                <td>Maria Cely</td>
                                <td>234554342</td>
                                <td>10/11/2019</td>
                                <td>17/11/2019</td>
                                <td>370.843</td>
                            </tr>
                        </table>
                        <br>
                    </div>
                </div>
            </div>

            <div class="button-return">
                <a href="/empresas">Regresar</a>
            </div>
        </div>

        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php"; 
        ?>

        
    <?php include "../../objetos/pie.php"; ?>
    </body>
</html>