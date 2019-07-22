<?php 

require_once '../static/modelo2.php';

$salida = new DatosBD();

$arreglo=$salida->consultaComando();
#print_r($arreglo['comando']);

if ($arreglo['comando']==""){
    $activo=0;
    
}else{
    $activo=1;
}



?>

<section class="page container">
    <div class="box">
        <div class="box-header"> 
            <i class="icon-play"></i>
            <h5>
                Comando
            </h5>
        </div>
        <div class="box-content" class="span16">
            <textarea id="idtext" style="width:1000px;height:80px" name="idtext" rows="10" cols="20"><?php print_r($arreglo['comando']);?></textarea>          
        </div>       


    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" name="action" onclick="guardar(document.getElementById('idtext').value)">Guardar</button>   
        <button id="submit-button" type="submit" class="btn btn-brand" name="action" onclick="probar(document.getElementById('idtext').value)" <?php if($activo==0) echo 'disabled'; ?>>Probar</button>                
        <button type="submit" class="btn btn-danger" name="action" onclick="eliminar()" <?php if($activo==0) echo 'disabled'; ?>>Eliminar</button>           
    </div>
</div> 
</section>
<script>
    
    function eliminar() {  
      
            var respuesta = confirm("¿Desea Eliminar el Comando?");
            if (respuesta === true){
                ejecutar();   
            }
    }
    function ejecutar() {
        $.ajax({
            url: "eliminacomando.php",
            success: function (resp) {
                alert(resp);
                //$('#resultado').html(resp)
                if (resp === "Datos Actualizados") {
                    location.reload();
                }
            }
        });

    }
    
    
    
    
    function probar(comando) {
        $.ajax({
            url: "pruebacomando.php",
            type: "POST",
            data: "comando=" + comando,
            success: function (resp) {
                alert(resp);
                //$('#resultado').html(resp)
                if (resp === "Comando Ejecutado") {
                    location.reload();
                }

            }
        });
    }

    function guardar(comando) {
        $.ajax({
            url: "guardacomando.php",
            type: "POST",
            data: "comando=" + comando,
            success: function (resp) {
                alert(resp);
                //$('#resultado').html(resp)
                if (resp === "Datos Actualizados") {
                    location.reload();
                }

            }
        });
    }

</script>