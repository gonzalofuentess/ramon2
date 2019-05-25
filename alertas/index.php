<?php
include '../static/sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <?php include '../static/head.html'; ?>

     <!--   <script type="text/javascript" src="../assets/google/loader.js"></script> -->
        <link href="../assets/tablexport/css/tableexport.min.css" rel="stylesheet"> 

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
                                    <h3>Alertas <br>
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
                                        <li class = "active"><a><i class="icon-warning-sign"></i>Alertas </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Código Página -->
                <section class="page container">
                    <div class="box">
                        <div class="box-header"> 
                            <i class="icon-table"></i>
                            <h5>
                                Alertas Emitidas
                            </h5>
                        </div>
                        <div class="box-content">
                            <?php
                            require_once '../static/modelo.php';
                            $raw = new Consulta();
                            $datos = $raw->buscaAlertas();
                            #print_r($datos);
                            ?>
                            <table id="tabla" class="table table-hover table-bordered tablesorter">
                                <thead>
                                    <tr>
                                        <th>N&uacute;mero</th>
                                        <th>Tipo de Alerta</th>
                                        <th>Inicio</th>
                                        <th>T&eacute;rmino</th>
                                        <th>Duraci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($datos as $key => $value) {
                                        ?>
                                        <tr>                                          
                                            <td><?php echo $value["idalerta"]; ?> </td> 
                                            <td><?php
                                                if ($value["idtipo"] == 1) {
                                                    echo "Silencio";
                                                } elseif ($value["idtipo"] == 2) {
                                                    echo "Señal Baja";
                                                } else {
                                                    echo "Señal Alta";
                                                }
                                                ?> </td> 
                                            <td><?php echo date("d-m-Y H:i:s", strtotime($value["inicio"])); ?> </td> 
                                            <td><?php if(!isset($value["termino"])){
                                                echo "Alerta en Proceso";
                                            }else{                                                
                                              echo  date("d-m-Y H:i:s", strtotime($value["termino"]));
                                            }                                            
                                             ?> </td> 
                                            <td><?php echo $value["duracion_horas"]; ?> </td>                                   
                                        </tr>  
                                        <?php
                                    }
                                    ?>                                  

                                </tbody>
                            </table>                        

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
        <script src="../assets/tablexport/js/FileSaver.min.js"></script>
        <script src="../assets/tablexport/js/Blob.min.js"></script>
        <script src="../assets/tablexport/js/xls.core.min.js"></script>
        <script src="../assets/tablexport/js/tableexport.js"></script>



        <script>
            $("#tabla").tableExport({formats: ["xlsx","txt"], });
        </script>

    </body>

</html>
