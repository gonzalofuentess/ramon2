<section class="page container">
    <div class="box">
        <div class="box-header"> 
            <i class="icon-play"></i>
            <h5>
                Comando
            </h5>
        </div>
        <div class="box-content" class="span16">
            <textarea id="idtext" style="width:1000px;height:80px" name="idtext" rows="10" cols="20"></textarea>
        </div>
        <div class="box-footer">          
            <button id="submit-button" type="submit" class="btn btn-brand" name="action" onclick="probar(document.getElementById('idtext').value)">Validar</button>
            <button type="submit" class="btn btn-primary" name="action" value="CANCEL">Guardar</button>           
        </div>
    </div> 
</section>
<script>
function probar(comando) {

        $.ajax({
            url: "pruebacomando.php",
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