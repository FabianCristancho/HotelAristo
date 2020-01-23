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
        </body>
</html>