<section class="page container">
    <div class="row">
        <div class="span8">
            <div class="box">
                <div class="box-header">
                    <i class="icon-rss"></i>
                    <h5>Radio</h5>
                </div>
                <div class="box-content">
                    <form class="form-inline">
                        <p>Frecuencia:</p>
                        <?php
                        require('../static/conexion.php');

                        /* Empezamos con el procedimiento de recuperación de una fila */
                        /* Lo primero es crear un objeto mysqli */
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        /* Y llamamos al procedimiento para recoger los datos */
                        /* Si falla imprimimos el error */
                        if (!($res = $conn->query("CALL radio()"))) {
                            echo "Falló la llamada: (" . $conn->errno . ") " . $conn->error;
                        }
                        /* E imprimimos el resultado para ver que el ejemplo ha funcionado */
                        $salida = $res->fetch_assoc();
                        ?>
                        <div class="input-prepend" id="form1">
                            <span class="add-on"><i class="icon-rss"></i></span>                         
                            <input id="senal" class="span4" type="number" min="88.1" max="107.9" step="0.1" placeholder="88.1 - 107.9" value="<?php echo $salida["frecuencia"]; ?>" required>
                        </div>                        
                    </form>
                    <form class="form-inline">
                        <p>Descripción:</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-pencil"></i></span>
                            <input id="descripcion" class="span4" type="text" maxlength="16" placeholder="Descripción Radio" maxlength="140" value="<?php echo $salida["descripcion"]; ?>" required>
                        </div>                        
                    </form>
                    <form class="form-inline">
                        <p>Tiempo de Silencio:</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-pencil"></i></span>
                            <input class="span4" id="tiempo" type="number" min="5" max="900" placeholder="Tiempo de Silencio Aceptable" value="<?php echo $salida["silencio"]; ?>" required>
                        </div>                        
                    </form>                    
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" onclick="hola(document.getElementById('senal').value, document.getElementById('descripcion').value, document.getElementById('tiempo').value)">
                        <i class="icon-ok"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <i class="icon-signal"></i>
                    <h5>Señal FM</h5>
                </div>
                <div class="box-content">
                    <script>
                        google.charts.load('current', {'packages': ['gauge']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                                ['Señal', 44]
                            ], true);

                            var options = {
                                width: 200, height: 220,
                                redFrom: 60, redTo: 100,
                                yellowFrom: 50, yellowTo: 60,
                                minorTicks: 15
                            };

                            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                            chart.draw(data, options);

                            setInterval(function () {
                                data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
                                chart.draw(data, options);
                            }, 1300)
                        }
                    </script>

                    <div id="chart_div" style="width: 400px; height: 120px;"></div> 
                    <br>
                    <br>
                    <br>
                    <br>
                </div>               
            </div>
        </div>
    </div>
</section>
<section class="page container">
    <div class="row">
        <div class="span8">        
            <div class="box">
                <div class="box-header">
                    <i class="icon-remove-sign"></i>
                    <h5>Señal Crítica:</h5>
                </div>
                <div class="box-content">                    
                    <form class="form-inline">
                        <p>Señal Baja</p>
                        <div class="input-prepend">                                                      
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                            <input class="span4" type="number" placeholder="Mínimo" value="0" readonly>
                        </div>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo" id="bajacriticaltext" min="1" max="70" disabled><input class="span1" type="checkbox" id="bajacritical">
                        </div> 
                        ¿Activar?
                    </form>

                    <form class="form-inline">
                        <p>Señal Alta</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                            <input class="span4" type="number" placeholder="Mínimo" id=""><input class="span1" type="checkbox" id="mincritical">
                        </div>
                        ¿Activar?
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo" value="70" readonly>
                        </div>
                    </form>                 
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-ok"></i>
                        Guardar
                    </button>
                </div>
            </div>       
        </div> 
        <div class="span8">        
            <div class="box">
                <div class="box-header">
                    <i class="icon-warning-sign"></i>
                    <h5>Señal Warning:</h5>
                </div>
                <div class="box-content">
                    <form class="form-inline">
                        <p>Señal Baja</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                            <input class="span4" type="number" placeholder="Mínimo" disabled>
                        </div>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo" id='bajawarningtext' disabled><input class="span1" type="checkbox" id="bajawarning">
                        </div>
                        ¿Activar?
                    </form>
                    <form class="form-inline">
                        <p>Señal Alta</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                            <input class="span4" type="number" placeholder="Mínimo">
                        </div>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo">
                        </div>
                    </form>                 
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary">
                        <i class="icon-ok"></i>
                        Guardar
                    </button>
                </div>
            </div>           

        </div> 
    </div>
</section>
<script>

    document.getElementById('bajacritical').onchange = function () {
        document.getElementById('bajacriticaltext').disabled = !this.checked;        
    };

</script>


<script>

    function hola(senal, descripcion, tiempo) {

        var anterior = <?php echo $salida["frecuencia"];
                        $conn->close();
                        ?>;
        if (anterior != senal) {
            var respuesta = confirm("Al modificar la frecuencia se eliminará el historial de registros asociados. ¿Desea Continuar?");
            if (respuesta === true)
                ejecutar(senal, descripcion, tiempo);
        } else
            ejecutar(senal, descripcion, tiempo);
    }
    function ejecutar(senal, descripcion, tiempo) {

        $.ajax({
            url: "ejecuta.php",
            type: "POST",
            data: "senal=" + senal + "&descripcion=" + descripcion + "&tiempo=" + tiempo,
            success: function (resp) {
                alert(resp);
                //$('#resultado').html(resp)
            }
        });

    }

</script>