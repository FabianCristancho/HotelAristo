<script type="text/javascript">
    /**
    * Función que se encarga de asignar al menú superior la página actual en la que se encuentra el usuario
    * @param page Página en la que se encuentra el usuario
    */
    function setCurrentPage(page){
        var button=document.getElementById(page);
        button.id="current-item";
        var image=button.getElementsByTagName("img")[0];
        image.src=image.src.replace("black","white");
    }
</script>

    <link rel="stylesheet" type="text/css" href="/css/menu.css">
    <header class="col-12">
        <a href="/inicio">
            <img id="logo-hotel" src="/res/img/logoA.png">
        </a>
    
        <button id="inicio" onclick="window.location.href = '/inicio';" class="main-menu-item menu-item" >
            <img src="/res/img/home-icon-black.png">
            <p>Inicio</p>
        </button>
        
        <div class="dropdown menu-item">
            <button id="registrar" onclick="window.location.href = '';"   class="main-menu-item">
                <img src="/res/img/register-icon-black.png">
                <p>Registrar</p>
            </button>
            <br>
            <div class="dropdown-content">
                <a href="/reservas/registrar">Registar reserva</a>
                <a href="/empresas/registrar">Registrar empresas</a>
                <a href="/usuarios/registrar">Registrar usuarios</a>
                <a href="/clientes/registrar">Registrar clientes</a>
            </div>
        </div>
        
        <div class="dropdown menu-item">
            <button id="consultar" onclick="window.location.href = '';" class="main-menu-item">
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
        
        <button id="control-diario" onclick="window.location.href = '/control_diario?date='+getDate(0);" class="main-menu-item menu-item">
            <img src="/res/img/control-icon-black.png">
            <p>Control diario</p>
        </button>
        
        <button id="facturas" onclick="window.location.href = '/facturas';" class="main-menu-item menu-item">
            <img src="/res/img/bill-icon-black.png">
            <p>Facturación</p>
        </button>

        <div class="user-area">
            <div class="dropdown menu-item">
            <button class="main-menu-item">
                <img src="/res/img/user-icon-black.png">
            </button>
            <br>
            <div class="dropdown-content-right">
                <a><?php echo $user->getFullName(); ?></a>
                <a href="/includes/logout.php"><i class="fa fa-power-off"></i> Cerrar sesión</a>
            </div>
        </div>
        </div>
    </header>
