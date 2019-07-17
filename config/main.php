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
                        require_once '../static/modelo.php';
                        $modelo = new Consulta();
                        $radio = $modelo->buscaRadio();
                        $arreglo = $modelo->buscaConfiguracion();
                        ?>
                        <div class="input-prepend" id="form1">
                            <span class="add-on"><i class="icon-rss"></i></span>                         
                            <input id="senal" class="span4" type="number" min="88.1" max="107.9" step="0.1" placeholder="88.1 - 107.9" value="<?php echo $radio[0]['frecuencia']; ?>" required>
                        </div>                        
                    </form>
                    <span><p id="freq"></p></span> 
                    <form class="form-inline">
                        <p>Descripción:</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-pencil"></i></span>
                            <input id="descripcion" class="span4" type="text" maxlength="16" placeholder="Descripción Radio" maxlength="140" value="<?php echo $radio[0]["descripcion"]; ?>" required>
                        </div>                        
                    </form>               
                    <span><p id="desc"></p></span> 
                    <form class="form-inline">
                        <p>Tiempo de Silencio:</p>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-pencil"></i></span>                           
                            <input class="span4" id="tiempo" type="number" min="5" max="900" placeholder="Tiempo de Silencio Aceptable" value="<?php echo $arreglo[0]["umbral"]; ?>" required>
                        </div>                                           
                    </form> 
                    <span><p id="sile"></p></span>   
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" onclick="radio(document.getElementById('senal').value, document.getElementById('descripcion').value, document.getElementById('tiempo').value)">
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
                    "current": <?php
                        $data = file_get_contents("senal.json");
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

                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo" id="bajacriticaltext" min="5" max="60" value="<?php echo $arreglo[1]['umbral']; ?>" <?php
                            if (($arreglo[1]['estado']) == 0) {
                                echo "disabled";
                            }
                            ?> >                            
                        </div>                         
                    </form> 
                    <span><p id="baj"></p></span> 
                    <div class="onoffswitch">
                        <input type="checkbox" name="switchbaja" class="onoffswitch-checkbox" id="switchbaja" <?php
                        if (($arreglo[1]['estado']) == 1) {
                            echo "checked";
                        }
                        ?>>
                        <label class="onoffswitch-label" for="switchbaja">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" onclick="baja(document.getElementById('bajacriticaltext').value)">
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
                            <input class="span4" type="number" min="10" max="65" placeholder="Mínimo" id="altacriticaltext" value="<?php echo $arreglo[2]['umbral']; ?>" <?php
                            if (($arreglo[2]['estado']) == 0) {
                                echo "disabled";
                            }
                            ?>>
                        </div>                       
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-up"></i></span>
                            <input class="span4" type="number" placeholder="Máximo" value="70" readonly>
                        </div>                        
                    </form>  
                    <span><p id="alt"></p></span> 
                    <div class="onoffswitch">
                        <input type="checkbox" name="switchalta" class="onoffswitch-checkbox" id="switchalta" <?php
                        if (($arreglo[2]['estado']) == 1) {
                            echo "checked";
                        }
                        ?>>
                        <label class="onoffswitch-label" for="switchalta">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" onclick="alta(document.getElementById('altacriticaltext').value)">
                        <i class="icon-ok"></i>
                        Guardar
                    </button>
                </div>
            </div>           

        </div> 
    </div>
</section>
<script>

    document.getElementById('switchbaja').onchange = function () {
        document.getElementById('bajacriticaltext').disabled = !this.checked;
    };
    document.getElementById('switchalta').onchange = function () {
        document.getElementById('altacriticaltext').disabled = !this.checked;
    };
</script>
<script>
    function radio(senal, descripcion, tiempo) {
        var descr = $.trim(descripcion);
        var ok = true;
        if (!descr) {
            $('#desc').html('<font color="red">Debe completar este campo</font>');
            ok = false;
        }
        if (tiempo < 5 || tiempo > 900 || !tiempo) {
            $('#sile').html('<font color="red">Debe ingresar un valor entre 5 y 900</font>');
            ok = false;
        }
        try {
            var res = senal * 10;
            if (res > 880 && res < 1080) {
                var anterior = <?php echo $radio[0]['frecuencia']; ?>;
                if (parseFloat(anterior) !== parseFloat(senal)) {
                    var respuesta = confirm("Al modificar la frecuencia se eliminará el historial de registros asociados. ¿Desea Continuar?");
                    if (respuesta === true)
                        if (ok) {
                            ejecutar(senal, descripcion, tiempo);
                        }
                } else
                if (ok) {
                    ejecutar(senal, descripcion, tiempo);
                }
            } else {
                $('#freq').html('<font color="red">Debe Ingresar un valor entre 88.1 y 107.9</font>');
            }
        } catch (err) {
            $('#freq').html('<font color="red">Debe Ingresar un valor entre 88.1 y 107.9</font>');
        }
    }

    function ejecutar(senal, descripcion, tiempo) {
        $.ajax({
            url: "ejecuta.php",
            type: "POST",
            data: "senal=" + senal + "&descripcion=" + descripcion + "&tiempo=" + tiempo,
            success: function (resp) {
                alert(resp);
                //$('#resultado').html(resp)
                if (resp === "Datos Actualizados") {
                    location.reload();
                }
            }
        });
    }

    function baja(bajacriticaltext) {
       if (document.getElementById('switchbaja').checked) {
            var est =<?php echo $arreglo[2]['estado']; ?>;
            if (est === 0) {
                if (bajacriticaltext > 60 || bajacriticaltext < 5) {
                    $('#baj').html('<font color="red">Debe ingresar un valor entre 5 a 60</font>');
                } else {
                    actualizabaja(bajacriticaltext);
                }
            } else {
                var max =<?php echo $arreglo[2]['umbral']; ?>;
                if (bajacriticaltext > max - 5 || bajacriticaltext > 60 || bajacriticaltext<5 ) {
                    $('#baj').html('<font color="red">Debe ingresar un valor entre 5 a ' + (max - 5) + '</font>');
                } else {
                    actualizabaja(bajacriticaltext);
                }
            }
        } else {
            actualizabaja(bajacriticaltext);
        }
       
    }
    function actualizabaja(bajacriticaltext) {
        $.ajax({
            url: "baja.php",
            type: "POST",
            data: "baja=" + document.getElementById('switchbaja').checked + "&bajacriticaltext=" + bajacriticaltext,
            success: function (resp) {
                alert(resp);
                //$('#resultado').html(resp)
                if (resp === "Datos Actualizados") {
                    location.reload();
                }
            }
        });
    }

    function alta(altacriticaltext) {
        if (document.getElementById('switchalta').checked) {
            var est =<?php echo $arreglo[1]['estado']; ?>;
            if (est === 0) {
                if (altacriticaltext > 65 || altacriticaltext < 10) {
                    $('#alt').html('<font color="red">Debe ingresar un valor entre 10 a 65</font>');
                } else {
                    actualizaalta(altacriticaltext);
                }
            } else {
                var min =<?php echo $arreglo[1]['umbral']; ?>;
                if (altacriticaltext < min + 5 || altacriticaltext > 65) {
                    $('#alt').html('<font color="red">Debe ingresar un valor entre ' + (min + 5) + ' y 65</font>');
                } else {
                    actualizaalta(altacriticaltext);
                }

            }
        } else {
            actualizaalta(altacriticaltext);
        }
    }
    function actualizaalta(altacriticaltext) {
        $.ajax({
            url: "alta.php",
            type: "POST",
            data: "alta=" + document.getElementById('switchalta').checked + "&altacriticaltext=" + altacriticaltext,
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

<!-- Resources -->


<!-- Chart code -->

