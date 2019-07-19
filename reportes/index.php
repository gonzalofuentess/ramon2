<?php
include '../static/sesion.php';
require_once '../static/modelo.php';
$modelo = new Consulta();
$destinatarios = $modelo->buscaDestinatario(2);
$horarios = $modelo->listarHora();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../static/head.html'; ?>

        <style>
            #chart {
                max-width: 380px;
                margin: 35px auto;
            }
        </style>

    </head>
    <body>
        <?php include '../static/encabezado.html'; ?>

        <div id="body-container">
            <div id="body-content">
                <?php include '../static/menu.html'; ?>
                <section class="nav nav-page">
                    <div class="container">
                        <div class="row">
                            <div class="span7">
                                <header class="page-header">                             
                                    <h3>Reportes <br>
                                        <small>Radio Monitoreo FM</small>
                                    </h3>
                                </header>
                            </div>
                            <div class="page-nav-options">
                                <div class="span9">
                                    <ul class="nav nav-pills">
                                        <li>
                                            <a href="../main/"><i class="icon-home icon-large"></i></a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#"><i class="icon-calendar"></i>Reportes</a>
                                        </li>                                                                           
                                    </ul>
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
                                    <i class="icon-pencil"></i>
                                    <h5>
                                        Agregar Destinatario
                                    </h5>
                                </div>
                                <div class="box-content">
                                    <form class="form-inline">
                                        <p>Dirección de Correo:</p>                      
                                        <div class="input-prepend" id="form1">
                                            <span class="add-on"><i class="icon-envelope"></i></span>                         
                                            <input id="mail" class="span6" type="text" required>
                                        </div>                        
                                    </form>                        
                                </div>
                                <div class="box-footer">
                                    <button type="button" class="btn btn-primary" onclick="destinatario(document.getElementById('mail').value)">
                                        <i class="icon-ok"></i>
                                        Guardar
                                    </button>
                                </div>            
                            </div>

                        </div>
                        <div class="span8">
                            <div class="box">
                                <div class="box-header">
                                    <i class="icon-group"></i>
                                    <h5>
                                        Destinatarios Actuales
                                    </h5>
                                </div>
                                <?php if (!$destinatarios) { ?>
                                    <h4 align='center'>Sin destinatarios</h4>               
                                <?php } else { ?>
                                    <div class="box-content box-table">
                                        <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Correo</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $variable = 1;
                                            foreach ($destinatarios as $dato) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $variable; ?></td>
                                                    <td><?php echo $dato['destinatario']; ?></td>
                                                    <td>                                        
                                                        <a class="btn btn-small btn-danger">                                            
                                                            <i class="btn-icon-only" onclick="elimina('<?php echo $dato['iddestinatario']; ?>')">Eliminar</i>
                                                        </a>
                                                    </td>
                                                </tr>    
                                                <?php
                                                $variable++;
                                            }
                                            ?>      
                                        </table>
                                    </div>  
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class = "page container">
                    <div class = "row">
                        <div class = "span8">
                            <div class = "box">
                                <div class = "box-header">
                                    <i class = "icon-pencil"></i>
                                    <h5>
                                        Agregar Programación
                                    </h5>
                                </div>                                
                                <div class = "box-content">
                                    <form class = "form-inline">
                                        <p>Horario:</p>
                                        <div class = "input-prepend" id = "form1">
                                            <span class = "add-on"><i class = "icon-edit"></i></span>
                                            <input id ="programacion" class = "span2" type = "time" required>
                                        </div>
                                    </form>
                                </div>
                                <div class = "box-footer">
                                    <button type = "button" class = "btn btn-primary" onclick = "agregaHora(document.getElementById('programacion').value)">
                                        <i class = "icon-ok"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class = "span8">
                            <div class = "box">
                                <div class = "box-header">
                                    <i class = "icon-time"></i>
                                    <h5>
                                        Programación Actual
                                    </h5>
                                </div>
                                 <?php if (!$horarios) { ?>
                                    <h4 align='center'>Sin programación</h4>               
                                <?php } else { ?>
                                <div class = "box-content box-table">
                                    <table id = "sample-table" class = "table table-hover table-bordered tablesorter">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Horario</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            $variable = 1;
                                            foreach ($horarios as $dato) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $variable; ?></td>
                                                    <td><?php echo $dato['horario']; ?></td>
                                                    <td>                                        
                                                        <a class="btn btn-small btn-danger">                                            
                                                            <i class="btn-icon-only" onclick="eliminaHora('<?php echo $dato['idprogramacion']; ?>')">Eliminar</i>
                                                        </a>
                                                    </td>
                                                </tr>    
                                                <?php
                                                $variable++;
                                            }
                                            ?>      

                                        </tbody>
                                    </table>
                                <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div id = "spinner" class = "spinner" style = "display:none;">
            Loading&hellip;
        </div>

        <footer class = "application-footer">
            <div class = "container">
                <p>Ramon</p>
                <div class = "disclaimer">
                    <p>Radio Monitoreo FM</p>
                    <p>Copyright © 2018-2019</p>
                </div>
            </div>
        </footer>

        <?php include '../static/script.html';
        ?>

        <script>
            function destinatario(correo) {

                $.ajax({
                    url: "destinatario.php",
                    type: "POST",
                    data: "correo=" + correo,
                    success: function (resp) {
                        alert(resp);
                        //$('#resultado').html(resp)
                        if (resp === "Datos Actualizados") {
                            location.reload();
                        }
                    }
                });
            }
            function elimina(destinatario) {
                $.ajax({
                    url: "elimina.php",
                    type: "POST",
                    data: "iddestinatario=" + destinatario,
                    success: function (resp) {
                        alert(resp);
                        //$('#resultado').html(resp)
                        if (resp === "Datos Actualizados") {
                            location.reload();
                        }
                    }
                });
            }
            
            function agregaHora(horario) {             
                $.ajax({
                    url: "agregahora.php",
                    type: "POST",
                    data: "horario=" + horario,
                    success: function (resp) {
                        alert(resp);
                        //$('#resultado').html(resp)
                        if (resp === "Datos Actualizados") {
                            location.reload();
                        }
                    }
                });
            }
            
            
            function eliminaHora(hora) {                
                $.ajax({
                    url: "eliminahora.php",
                    type: "POST",
                    data: "idhora=" + hora,
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
    </body>
</html>
