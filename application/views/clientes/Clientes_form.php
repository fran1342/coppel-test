<form id="form_clientes">

    <?php if(@$cliente_seleccionado){ ?> 
        <input type="hidden" name="clave_e" id="clave_e" value="<?=@$cliente_seleccionado->id_usuario;?>">
        <input type="hidden" name="accion" id="accion" value="<?=@$accion;?>">
    <?php }?>

    <div class="modal-header">
    <?php
        if (@$accion) {
            if ($accion == "borrar") {
                $titulo = "Borrar";
                //$titulo2 = $cliente_seleccionado->tipo_usuario;
                
            }else {
                $titulo = "Editar";
                //$titulo2 = $cliente_seleccionado->tipo_usuario;
            }
      
        }else{
            $titulo = "Registrar";
            $titulo2 = "Selecciona una opci&oacute;n";
        }
  ?>
        
    <h5 class="modal-title">Formulario clientes - <?=$titulo?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Nombre(s):</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="nombre_e" id="nombre_e" value="<?=@$cliente_seleccionado->nombre_usuario;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Apellido(s):</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="apellido_e" id="apellido_e" value="<?=@$cliente_seleccionado->apellidos_usuario;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Tel&eacute;fono:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="tel_e" id="tel_e" value="<?=@$cliente_seleccionado->tel_usuario;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Usuario:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="user_e" id="user_e" value="<?=@$cliente_seleccionado->user_usuario;?>">
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>