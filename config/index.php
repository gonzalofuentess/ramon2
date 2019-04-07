<?php
include '../static/sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../static/head.html'; ?>


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
                                    <h3>Configuración <br>
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

                                        <?php
                                        if (isset($_GET["menu"])) {
                                            switch ($_GET["menu"]) {
                                                case "correo":
                                                    ?>
                                                    <li><a href="../config/"><i class="icon-home"></i>Radio</a></li>
                                                    <li class="active"><a><i class="icon-envelope-alt"></i>Correo</a></li>                                                   
                                                    <?php
                                                    break;
                                            }
                                        } else {
                                            ?>
                                            <li class = "active"><a><i class="icon-home"></i>Radio </a></li>
                                            <li><a href = "../config/index.php?menu=correo"><i class="icon-envelope-alt"></i>Correo</a></li>
                                        <?php }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <?php
                if (isset($_GET["menu"])) {
                    
                    switch ($_GET["menu"]){
                        case  "correo":
                            
                            include './correo.html';
                            break;                        
                        
                    }
                    
                } else {

                    include './main.html';
                }
                ?>


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
