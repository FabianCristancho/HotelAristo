  
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

    <?php
        include "../objetos/menu.php"; 
    ?>
    <script type="text/javascript">
        setCurrentPage("inicio");
    </script>
    
    <div class="content">
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
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../objects/footer.php"; 
        ?>
        
    </body>

</html>