<?php
include '../static/sesion.php';
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
                                            <input id="correo" class="span6" type="text" required>
                                        </div>                        
                                    </form>                        
                                </div>
                                <div class="box-footer">
                                    <button type="button" class="btn btn-primary" onclick="radio(document.getElementById('senal').value, document.getElementById('descripcion').value, document.getElementById('tiempo').value)">
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
                                <div class="box-content box-table">
                                    <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Correo</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>gonzalo.fuentes12@inacapmail.cl</td>
                                                <td class="td-actions">                              

                                                    <a href="javascript:;" class="btn btn-small btn-danger">
                                                        <i class="btn-icon-only icon-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>                         

                                        </tbody>
                                    </table>
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
                                        Agregar Programación
                                    </h5>
                                </div>
                                <div class="box-content">
                                    <form class="form-inline">
                                        <p>Horario:</p>                      
                                        <div class="input-prepend" id="form1">
                                            <span class="add-on"><i class="icon-edit"></i></span>                         
                                            <input id="correo" class="span2" type="time" required>
                                        </div>                        
                                    </form>                        
                                </div>
                                <div class="box-footer">
                                    <button type="button" class="btn btn-primary" onclick="radio(document.getElementById('senal').value, document.getElementById('descripcion').value, document.getElementById('tiempo').value)">
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
                                        Programación Actual
                                    </h5>
                                </div>
                                <div class="box-content box-table">
                                    <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Horario</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>08:00</td>
                                                <td class="td-actions">                              

                                                    <a href="javascript:;" class="btn btn-small btn-danger">
                                                        <i class="btn-icon-only icon-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>                         

                                        </tbody>
                                    </table>
                                </div>                     
                            </div>
                        </div>
                    </div>
                </section>


            </div>
        </div>
        <div id="spinner" class="spinner" style="display:none;">
            Loading&hellip;
        </div>

        <footer class="application-footer">
            <div class="container">
                <p>Ramon</p>
                <div class="disclaimer">
                    <p>Radio Monitoreo FM</p>
                    <p>Copyright © 2018-2019</p>
                </div>
            </div>
        </footer>

        <?php include '../static/script.html'; ?>





    </body>

</html>
