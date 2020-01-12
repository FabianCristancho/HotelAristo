  
<?php
    require_once '../includes/classes.php';
    $user = new User();
    $userSession = new UserSession();
    
    if(isset($_SESSION['user'])){
        $user->updateDBUser($userSession->getSession());
    }else{
        header('location: /login');
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Inicio | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link rel="stylesheet" type="text/css" href="/css/inicio.css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1366.css">
        <link rel="stylesheet" type="text/css" href="/css/alerts.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
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
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "inicio"
            */
            setCurrentPage("inicio");
        </script>
    
        <div class="content wrap-main">
            <div class="title">
                <p><strong>HOTEL ARISTO</strong></p>
            </div>
            <div class="menu">
                <a href="/reservas/" class="button">
                    <p>Reservas</p>
                    <img src="../res/img/book-icon-white.png">
                </a>
                <a href="/habitaciones/" class="button">
                    <p>Historial de Habitación</p>
                    <img src="/res/img/room-icon-white.png">
                </a>
                <a href="/control_diario/" class="button">
                    <p>Control diario</p>
                    <img src="/res/img/control-icon-white.png">
                </a>
                <a href="/usuarios/" class="button">
                    <p>Usuarios</p>
                    <img src="/res/img/use-whiter.png">
                </a>
                <a href="/empresas/" class="button">
                    <p>Empresas</p>
                    <img src="/res/img/company-white.png">
                </a>
                <a href="/facturas/" class="button">
                    <p>Facturación</p>
                    <img src="/res/img/bill-icon-white.png">
                </a>
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