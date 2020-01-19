<?php
    require_once 'includes/classes.php';

    $user = new User();
    $userSession = new UserSession();
    
    if(isset($_SESSION['user'])){
        $user->updateDBUser($userSession->getSession());
    }else{
        header('location: /login');
    }
?>

<html>
        <head>
            <title>Hotel Aristo</title>
            <link rel="manifest" href="/manifest.json">
        </head>
        
        <body>
            <a href="hotelaristo.crt">Descargar certificado <strong>hotelaristo.tj</strong></a>
            <a href="ip-hotelaristo.crt">Descargar certificado <strong>192.168.0.17</strong></a>
        </body>
</html>