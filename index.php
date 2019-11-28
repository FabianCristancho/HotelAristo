<?php
    include_once 'includes/database.php';
    $DB= new Database();
    $query=$DB->connect()->prepare('select nombre_usuario from usuarios');
    $query->execute();
?>
<html>
        <head>
            <title>Hotel Aristo</title>
        </head>
        
        <body>
            <h1>Hola mundo</h1>
            <?php
            foreach($query as $current){
                echo '<p>'.$current['nombre_usuario'].'</p>';
            }
            ?>
        </body>
</html>