<?php
    include_once '../includes/database.php';
    include_once '../includes/consult.php';
    $consult=new Consult();
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
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "consultar"
            */
            setCurrentPage("consultar");
        </script>


		<div class="marco nearly-page">
            <h1>EMPRESAS REGISTRADAS</h1>
            <div class="scroll-block">
                <table>
                    <thead>
                        <tr>
                            <th>NIT</th>
                            <th>NOMBRE</th>
                            <th>TELEFONO</th>
                            <th>RETEFUENTE (3,5 %)</th>
                            <th>OTRO IMPUESTO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                        $consult->getTable('enterprise');
                    ?>
                </table>
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
