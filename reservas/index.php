<!DOCTYPE html>
<html>
    <body>
    <!--Menu de la aplicación web del hotel Aristo la clase main-menu-item pertenece a los botones del menú-->
      <?php
            /**
            * Incluye la implementación de la clase menu, archivo que crea el menú superior de la aplicación web
            */
            include "../objects/menu.php"; 
        ?>

        <div id="content" class="col-12">
            <div class="marco nearly-page">
                <h3 id="requests-title" class="col-9">Reservas de huéspedes</h3>
                <a id="button-add-book" class="col-2" href="">Nueva reserva</a>

                <table>
                    <tr>
                      <th>N°</th>
                      <th>Check in</th>
                      <th>Check on</th>
                      <th>Nombre completo</th>
                      <th>Telefono</th>
                      <th>Fecha de llegada</th>
                      <th>Fecha de salida</th>
                      <th>Cantidad de noches</th>
                      <th>Empresa</th>
                      <th>Correo</th>
                    </tr>
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