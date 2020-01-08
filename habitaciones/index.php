<!DOCTYPE html>
<html>
    <body onload ="getDate('control-date',0);">  
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
            <h1>HISTORIAL DE HABITACIONES</h1>
            
            <div class="history-room">
                <div class="view-date-history">
                    <label><b>Fecha De Visualización</b></label>
                    <br><br>
                    <label>Fecha Inicial &emsp; &emsp; &emsp; &ensp; Fecha Final</label>

                    <br>
                    <input id="control-date" type="date">
                    <input id="control-date" type="date">
                </div>
            
                <div class="view-room-history">
                    <label><b>Habitación</b></label>
                    <select class="lista-habitaciones">
                        <option>201</option>
                        <option>202</option>
                        <option>301</option>
                        <option>302</option>
                        <option>303</option>
                        <option>304</option>
                        <option>401</option>
                        <option>402</option>
                        <option>403</option>
                        <option>404</option>
                        <option>501</option>
                        <option>502</option>
                        <option>503</option>
                        <option>504</option>
                        <option>601</option>
                        <option>602</option>
                        <option>603</option>
                    </select>
                </div>
            </div>
            
			<table>
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Huésped(es)</th>
                        <th>Valor consumo ($)</th>
                        <th>Actividad</th>
                        <th></th>
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