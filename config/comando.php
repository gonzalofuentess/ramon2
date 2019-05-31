<section class="page container">
    <div class="row">      
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Warning!</strong> Best check yo self, you're not looking too good.
        </div>


        <div id="acct-password-row" class="span7">
            <fieldset class="span10">
                <legend>Servidor</legend><br>
                <div class="control-group ">
                    <label class="control-label">Dirección Servidor <span class="required"></span></label>
                    <div class="controls">
                        <input id="servidor" name="servidor" class="span4" type="text" value="">

                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label">Puerto</label>
                    <div class="controls">
                        <input id="puerto" name="puerto" min="0" max="65535" class="span4" type="number" value="">

                    </div>
                </div>                   
            </fieldset>
        </div>
        <div id="acct-verify-row" class="span9">
            <fieldset>
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
                        <input id="correo-usuario" name="correo-usuario" class="span5" type="text" value="">

                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label">Contraseña</label>
                    <div class="controls">
                        <input id="correo-password" name="correo-password" class="span5" type="password" value="">

                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <footer id="submit-actions" class="form-actions">
        <button id="submit-button" type="submit" class="btn btn-brand" name="action" value="CONFIRM">Validar</button>
        <button type="submit" class="btn btn-primary" name="action" value="CANCEL">Guardar</button>
    </footer>     
</section>