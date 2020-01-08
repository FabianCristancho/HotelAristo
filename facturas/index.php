<!DOCTYPE html>
<html>
    <head>
        <title>Facturas | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <script type="text/javascript" src="/js/moment.js"></script>
        <script type="text/javascript" src="/js/dynamic.js"></script>
    </head>

    <body>
        <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "facturas"
            */
            setCurrentPage("facturas");
        </script>

        <div id="content" class="col-12">
            <div class="marco nearly-page">
                <h1 class="heading">FACTURAS (Registro es un ejemplo para enlazar reportes)</h1>
                <a href="factura" id="button-more-info" class="btn-new-bill">NUEVA FACTURA</a>
                <div class="scroll-block">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FECHA DE FACTURACIÓN</th>
                                <th>HUÉSPED</th>
                                <th>VALOR FACTURADO($)</th>
                                <th>RESPONSABLE</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../objects/footer.php"; 
        ?>
        
    </body>
</html>
