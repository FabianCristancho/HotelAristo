<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/res/img/famicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/register.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <title>Registro | Hotel Aristo</title>
</head>
<body>
        <header class="col-12">
            <a href="/inicio">
                <img id="logo-hotel" src="/res/img/logoA.png">
            </a>
            <button onclick="window.location.href = '/inicio';" class="main-menu-item menu-item" >
                <img src="/res/img/home-icon-black.png">
                <p>Inicio</p>
            </button>

            <div class="dropdown menu-item">
                    <button onclick="window.location.href = '';"   class="main-menu-item">
                        <img src="/res/img/book-icon-black.png">
                        <p>Registrar</p>
                    </button>
                    <br>
                    <div class="dropdown-content">
                        <a href="/nueva_reserva">Registar reserva</a>
                        <a href="/nueva_empresa">Registrar empresas</a>
                    </div>
                </div>

                <div class="dropdown menu-item">
                    <button onclick="window.location.href = '';" class="main-menu-item">
                        <img src="/res/img/book-icon-black.png">
                        <p>Consultar</p>
                    </button>
                    <br>
                    <div class="dropdown-content">
                        <a href="/reservas">Consultar reservas</a>
                        <a href="/clientes">Consultar clientes</a>
                        <a href="/empresas">Consultar empresas</a>
                        <a href="/habitaciones">Consultar habitaciones</a>
                    </div>
                </div>


                <button id="current-item" onclick="window.location.href = '/control_diario';" class="main-menu-item menu-item">
                    <img src="/res/img/control-icon-white.png">
                    <p>Control diario</p>
                </button>
                <button onclick="window.location.href = '';" class="main-menu-item menu-item">
                    <img src="/res/img/bill-icon-black.png">
                    <p>Facturación</p>
                </button>

                <button onclick="window.location.href = '/includes/logout.php';" class="main-menu-item menu-item">
                    <img src="/res/img/logout-icon-black.png">
                    <p>Cerrar sesión</p>
                </button>
        </header>
    
    <div class="contenedor-formulario">
        <div class="wrap">
            <!-- Formulario -->
            <form action="" class="formulario" name="formulario_registro" method="post">  
                <div>
                    <h2>REGISTRAR USUARIO</h2>
                    <div class="input-group">
                        <input type="text" id="nombre" name="nombre">
                        <label class="label" for="nombre">Nombres</label>
                    </div>
                    <div class="input-group">
                        <input type="text" id="last-name" name="last-name">
                        <label class="label" for="last-name">Apellidos</label>
                    </div>
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
                    <div class="input-group">
                        <input type="text" id="phone" name="phone">
                        <label class="label" for="phone">Teléfono</label>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email">
                        <label class="label" for="email">Correo electrónico</label>
                    </div>
                    <div class="input-group">
                        <label class="label_combo" for="charge">Cargo</label>
                        <select id="charge" class="combo">
                            <option value="DA">Directora Administrativa</option>
                            <option value="CD">Coordinadora</option>
                            <option value="RC">Recepcionista</option>
                            <option value="CM">Camarera</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" id="nickname" name="nickname">
                        <label class="label" for="nickname">Nombre de usuario</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="pass" name="pass">
                        <label class="label" for="pass">Contraseña</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="pass2" name="pass2">
                        <label class="label" for="pass2">Repetir Contraseña</label>
                    </div>
                    <input type="submit" id="btn-submit" value="Enviar">
                    <a href="#"><b>¿Ya tiene cuenta? Iniciar sesión</b></a>
                </div>
            </form>
        </div>
        
    </div>
    <script src="/js/formulario.js"></script>
    <footer>
        <p>Copyright 2019<a href="/home/index.php">Hotel Aristo</a> | Todos los derechos reservados</p>
    </footer>
</body>
</html>