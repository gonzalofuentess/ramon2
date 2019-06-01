<section class="page container"> 
    <div class="row">
        <div class="span16">
            <div class="box">
                <div class="box-header">
                    <i class="icon-cogs"></i>
                    <h5>
                        Configuración Servidor Correo
                    </h5>
                </div>
                <div class="row">
                    <div id="acct-password-row" class="span8">
                        <fieldset class="span6">
                            <legend>Servidor</legend><br>
                            <div class="control-group ">
                                <label class="control-label">Dirección Servidor <span class="required"></span></label>
                                <div class="controls">
                                    <input id="servidor" name="servidor" class="span5" type="text" value="">

                                </div>
                            </div>
                            <div class="control-group ">
                                <label class="control-label">Puerto</label>
                                <div class="controls">
                                    <input id="puerto" name="puerto" min="0" max="65535" class="span5" type="number" value="">

                                </div>
                            </div>    
                            <p>STARTTLS</p>
                            <div class="onoffswitch">
                                <input type="checkbox" name="switchtls" class="onoffswitch-checkbox" id="switchtls" checked>
                                <label class="onoffswitch-label" for="switchtls">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>                                
                            </div>                      
                        </fieldset>
                    </div>
                    <div id="acct-verify-row" class="span7">
                        <fieldset class="span6">
                            <legend>Autenticación</legend>
                            <div class="control-group">
                                <label for="autenticacion" class="control-label">¿Requiere Autenticación?</label>
                                <div class="controls">
                                    <select onchange="autentica.call(this, event)" id="autenticacion" class="span5">
                                        <option value="">SI</option>
                                        <option value="">NO</option>                                                                                       
                                    </select>
                                </div>
                            </div>
                            <div class="control-group ">
                                <label class="control-label">Usuario</label>
                                <div class="controls">
                                    <input id="correousuario" name="correousuario" class="span5" type="text" value="">

                                </div>
                            </div>
                            <div class="control-group ">
                                <label class="control-label">Contraseña</label>
                                <div class="controls">
                                    <input id="correopassword" name="correopassword" class="span5" type="password" value="">

                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" onclick="server(document.getElementById('servidor').value, document.getElementById('puerto').value,document.getElementById('autenticacion').value,document.getElementById('correousuario').value,document.getElementById('correopassword').value)">
                        <i class="icon-ok"></i>
                        Guardar
                    </button>
                </div> 
            </div>
        </div>
    </div>

</section>
<script>
    function autentica(event) {

        valor = this.options[this.selectedIndex].text;

        if (valor === "NO") {

            document.getElementById("correousuario").disabled = true;
            document.getElementById("correopassword").disabled = true;
            document.getElementById("correousuario").value = "";
            document.getElementById("correopassword").value = "";

        } else {
            document.getElementById("correousuario").disabled = false;
            document.getElementById("correopassword").disabled = false;

        }
        //alert(this.options[this.selectedIndex].text);

    }
</script>
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
</section>

<script>

function server(servidor,puerto,correousuario,correopassword,) {
var e = document.getElementById("autenticacion");
//var value = e.options[e.selectedIndex].value;
var autenticacion = e.options[e.selectedIndex].text;

        $.ajax({
            url: "server.php",
            type: "POST",
            data: "servidor=" + servidor + "&puerto=" + puerto + "&switchtls=" + document.getElementById('switchtls').checked + "&autenticacion=" + autenticacion + "&correousuario=" + correousuario + "&correopassword=" + correopassword,
            success: function (resp) {
                alert(resp);
                //$('#resultado').html(resp)
               // if (resp === "Datos Actualizados") {
                //    location.reload();
                //}

            }
        });

    }
    
    function destinatario(){
        
        
    }


</script>