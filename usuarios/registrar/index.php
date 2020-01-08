<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro de usuarios | Hotel Aristo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/res/img/famicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/register.css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">    
        <link rel="stylesheet" type="text/css" href="/css/main-800.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1024.css">
        <link rel="stylesheet" type="text/css" href="/css/main-1220.css">
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
            include "../../objects/menu.php"; 
        ?>
        
        <script type="text/javascript">
            /**
            * Implementa el método setCurrentPage() pasando como parámetro la cadena de texto "registrar"
            */
            setCurrentPage("registrar");
        </script>

        <div class="contenedor-formulario">
            <div class="wrap">
                <!-- Formulario -->
                <form action="" class="formulario" name="formulario_registro" method="post">  
                    <div>
                        <h2>REGISTRAR USUARIO</h2>
                        <div class="line-group">
                            <div class="input-group">
                                <input type="text" id="nombre" name="nombre">
                                <label class="label" for="nombre">Nombres</label>
                            </div>
                            <div class="input-group">
                                <input type="text" id="last-name" name="last-name">
                                <label class="label" for="last-name">Apellidos</label>
                            </div>
                        </div>

                        <div class="line-group">
                            <div class="input-group">
                                <label class="label_combo" for="type_id">Tipo de documento</label>
                                <select id="type_id" class="combo">
                                    <option value="RG">Registro Civil</option>
                                    <option value="TI">Tarjeta de identidad</option>
                                    <option value="CC">Cédula de Ciudadanía</option>
                                    <option value="CC">Cédula de Extranjería</option>
                                    <option value="CC">Pasaporte</option>
                                </select>
                            </div>

                            <div class="input-group">
                                <input type="text" id="document" name="document">
                                <label class="label" for="document">Número de Documento</label>
                            </div>
                        </div>

                        <div class="line-group">
                            <div class="input-group">
                                <input type="text" id="phone" name="phone">
                                <label class="label" for="phone">Teléfono</label>
                            </div>

                            <div class="input-group">
                                <input type="email" id="email" name="email">
                                <label class="label" for="email">Correo electrónico</label>
                            </div>
                        </div>

                        <div class="line-group">
                            <div class="input-group">
                                <label class="label_combo" for="charge">Cargo</label>
                                <select id="charge" class="combo">
                                    <option value="DA">Director/a Administrativa</option>
                                    <option value="CD">Coordinadora</option>
                                    <option value="RC">Recepcionista</option>
                                    <option value="CM">Camarera</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="text" id="nickname" name="nickname" disabled>
                                <label class="label" for="nickname">Nombre de usuario</label>
                            </div>
                        </div>

                        <div class="line-group">
                            <div class="input-group">
                                <input type="password" id="pass" name="pass">
                                <label class="label" for="pass">Contraseña</label>
                            </div>
                            <div class="input-group">
                                <input type="password" id="pass2" name="pass2">
                                <label class="label" for="pass2">Repetir Contraseña</label>
                            </div>
                        </div>

                        <input type="submit" id="btn-submit" value="Registrar">
                    </div>
                </form>
            </div>

        </div>
        <script src="/js/formulario.js"></script>
        
        <?php
            /**
            * Incluye la implementación del archivo que contiene el footer con la información de la aplicación web
            */
            include "../../objects/footer.php"; 
        ?>
        
    </body>
</html>