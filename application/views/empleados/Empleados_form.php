<form id="form_empleados">

    <?php if(@$empleado_seleccionado){ ?> 
        <input type="hidden" name="clave_e" id="clave_e" value="<?=@$empleado_seleccionado->id_usuario;?>">
        <input type="hidden" name="accion" id="accion" value="<?=@$accion;?>">
    <?php }?>

    <div class="modal-header">
    <?php
        if (@$accion) {
            if ($accion == "borrar") {
                $titulo = "Borrar";
                $titulo2 = $empleado_seleccionado->tipo_usuario;
                
            }else {
                $titulo = "Editar";
                $titulo2 = $empleado_seleccionado->tipo_usuario;
            }
      
        }else{
            $titulo = "Registrar";
            $titulo2 = "Selecciona una opci&oacute;n";
        }
  ?>
        
    <h5 class="modal-title">Formulario empleados - <?=$titulo?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Nombre(s):</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="nombre_e" id="nombre_e" value="<?=@$empleado_seleccionado->nombre_usuario;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Apellido(s):</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="apellido_e" id="apellido_e" value="<?=@$empleado_seleccionado->apellidos_usuario;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Tel&eacute;fono:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="tel_e" id="tel_e" value="<?=@$empleado_seleccionado->tel_usuario;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Usuario:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="user_e" id="user_e" value="<?=@$empleado_seleccionado->user_usuario;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Tipo:</label>
                <select class="form-control" <?=@$accion == "borrar" ? 'disabled' : '';?> name="tipo_e" id="tipo_e" values="<?=@$empleado_seleccionado->tipo_usuario;?>">
                    <option value="" selected disabled><?=$titulo2?></option>
                    <option value="Empleado">Empleado</option>
                    <option value="Veterinario">Veterinario</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>