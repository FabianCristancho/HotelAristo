<!--Contiene el bloque correspondiente a las alertas emitidas por el sistema luego de presentarse algún evento ya sea inesperado o controlado por el usuario-->
<div id="alerts">
    <div id="alert-d" class="alert danger">
        <span onclick="hideAlert('alert-d');" class="closebtn">&times;</span>  
        <strong>¡Peligro!</strong> 
        <p></p>
    </div>
    <div id="alert-s" class="alert success">
        <span onclick="hideAlert('alert-s');" class="closebtn">&times;</span>  
        <strong>¡Procedimiento exitoso!</strong> 
        <p></p>
    </div>
    <div id="alert-i" class="alert info">
        <span onclick="hideAlert('alert-i');" class="closebtn">&times;</span>  
        <strong>Información!</strong> 
        <p></p>
    </div>
                
    <div id="alert-w" class="alert warning">
        <span onclick="hideAlert('alert-w');" class="closebtn">&times;</span>  
        <strong>¡Precaución!</strong> 
        <p><p>
    </div>
</div>