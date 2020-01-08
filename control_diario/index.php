<?php
    require_once '../includes/classes.php';

    $consult=new Consult();
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
    <body onload ="getDate('control-date',0); checkColors();">
        <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            setCurrentPage("control-diario");
        </script>

	<div id="content" class="col-12">

		<div class="marco nearly-page">
            <h1>CONTROL DE HABITACIONES</h1>

            <div class="input-block-control">
					<label>Fecha control</label>
					<br>
                    <button>&lt;</button>
					<input id="control-date" type="date">
                    <button>&gt;</button>
            </div>
        </div>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../objects/footer.php"; 
        ?>

            <div class="scroll-block">
                <table>
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Tipo de habitación</th>
                        <th>Nombre huésped(es)</th>
                        <th>Fecha ingreso</th>
                        <th>Conteo diario</th>
                        <th>Total ($)</th>
                        <th>Check up</th>
                        <th>Check out</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                    $consult->getTable('room');
                ?>
            </table>
            </div>
		</div>
	</div>
	<div id="aux-footer" class="col-12"></div>
    <?php include "../objetos/pie.php"; ?>

</body>
</html>
