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
        <script>
            Chart.defaults.global.animation.duration = 0;
            Chart.defaults.global.defaultFontSize = 12;

            var configDirection = {
                "type": "gauge",
                "data": {
                    "datasets": [
                        {
                            "data": [],
                            "backgroundColor": [],
                            "borderWidth": 0,
                            "hoverBackgroundColor": [],
                            "hoverBorderWidth": 0
                        }
                    ],
                    "current": <?php $data = file_get_contents("senal.json");
                                 $datos = json_decode($data, true);
                                 echo $datos['senal'];
                              ?>,
                },
                "options": {
                    "panel": {
                        "min": 0,
                        "max": 70,
                        "tickInterval": 1,
                        "tickColor": "rgb(0, 0, 0)",
                        "tickOuterRadius": 99,
                        "tickInnerRadius": 95,
                        "scales": [0, 10, 20, 30, 40, 50, 60, 70, ],
                        "scaleColor": "rgb(0, 0, 0)",
                        "scaleBackgroundColor": "rgb(105, 125, 151)",
                        "scaleTextRadius": 80,
                        "scaleTextSize": 8,
                        "scaleTextColor": "rgba(0, 0, 0, 1)",
                        "scaleOuterRadius": 99,
                        "scaleInnerRadius": 93,
                    },
                    "needle": {
                        "lengthRadius": 100,
                        "circleColor": "rgba(188, 188, 188, 1)",
                        "color": "rgba(180, 0, 0, 0.8)",
                        "circleRadius": 7,
                        "width": 5,
                    },
                    "cutoutPercentage": 90,
                    "rotation": -Math.PI,
                    "circumference": Math.PI,
                    "legend": {
                        "display": false,
                        "text": "legend"
                    },
                    "tooltips": {
                        "enabled": false
                    },
                    "title": {
                        "display": true,
                        "text": "Señal",
                        "position": "bottom"
                    },
                    "animation": {
                        "animateRotate": false,
                        "animateScale": false
                    },
                    "hover": {
                        "mode": null
                    }
                }
            };
            window.onload = function () {
                var ctx = document.getElementById('chart-direction').getContext('2d');
                window.direction = new Chart(ctx, configDirection);

            };
            setInterval(function () {
                var JSON = $.ajax({
                    url: "senal.php",
                    dataType: 'json',
                    async: false}).responseText;
                var Respuesta = jQuery.parseJSON(JSON);
                configDirection.data.current = Respuesta.senal;
                window.direction.update();
            }, 1300);
        </script>
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <i class="icon-signal"></i>
                    <h5>Señal FM</h5>
                </div>
                <div class="box-content">        
                    <canvas id="chart-direction"></canvas>                   
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
                    <i class="icon-warning-sign"></i>
                    <h5>Señal Baja Crítica:</h5>
                </div>
                <div class="box-content">                    
                    <form class="form-inline">
                        <p>Señal Baja</p>                         
                        <div class="input-prepend">                                                      
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                            <input class="span4" type="number" placeholder="Mínimo" value="0" readonly>
                        </div>
                        <div class="input-prepend">
                            <?php
                            require_once '../static/modelo.php';
                            $modelo = new Consulta();
                            $arreglo = $modelo->buscaConfiguracion();
                            ?>
                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo" id="bajacriticaltext" min="1" max="70" value="<?php echo $arreglo[1]['umbral']; ?>" <?php
                            if (($arreglo[1]['estado']) == 0) {
                                echo "disabled";
                            }
                            ?>><input class="span1" type="checkbox" id="bajacritical" <?php
                                   if (($arreglo[1]['estado']) == 1) {
                                       echo "checked";
                                   }
                                   ?>>
                        </div>

                        ¿Activar?
                    </form>   
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
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
                    <h5>Señal Alta Crítica:</h5>
                </div>
                <div class="box-content">
                    <form class="form-inline">
                        <p>Señal Alta</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                            <input class="span4" type="number" placeholder="Mínimo" id="altacriticaltext" disabled><input class="span1" type="checkbox" id="altacritical">
                        </div>
                        ¿Activar?
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo" value="70" readonly>
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


    document.getElementById('altacritical').onchange = function () {
        document.getElementById('altacriticaltext').disabled = !this.checked;
    };

</script>
<script>

    function hola(senal, descripcion, tiempo) {

        var anterior = <?php
                                   echo $salida["frecuencia"];
                                   $conn->close();
                                   ?>;
        if (anterior !== senal) {
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

<!-- Resources -->


<!-- Chart code -->

