<form id="form_mascotas">

    <?php if(@$mascota_seleccionada){ ?> 
        <input type="hidden" name="clave_e" id="clave_e" value="<?=@$mascota_seleccionada->id_mascota;?>">
        <input type="hidden" name="accion" id="accion" value="<?=@$accion;?>">
    <?php }?>

    <div class="modal-header">
    <?php
        if (@$accion) {
            if ($accion == "borrar") {
                $titulo = "Borrar";
                $titulo2 = $mascota_seleccionada->nombre_usuario;
                
            }else {
                $titulo = "Editar";
                $titulo2 = $mascota_seleccionada->nombre_usuario;
            }
      
        }else{
            $titulo = "Registrar";
            $titulo2 = "Selecciona una opci&oacute;n";
        }
        //echo var_dump($clientes);
  ?>
        
    <h5 class="modal-title">Formulario mascotas - <?=$titulo?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Nombre(s):</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="nombre_m" id="nombre_m" value="<?=@$mascota_seleccionada->nombre_mascota;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Raza:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="raza_m" id="raza_m" value="<?=@$mascota_seleccionada->raza_mascota;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Edad:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="edad_m" id="edad_m" value="<?=@$mascota_seleccionada->edad_mascota;?>">
            </div>
            <div class="col-10 form-group">
                <label>Foto:</label>
                <input type="file" <?=@$accion == "borrar" ? 'disabled' : '';?> class="" name="foto_m" id="foto_m" value="<?=@$mascota_seleccionada->foto_mascota;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Propietario:</label>
                <select class="form-control" <?=@$accion == "borrar" ? 'disabled' : '';?> name="dueno_m" id="dueno_m">
                    <option value="" selected disabled><?=$titulo2;?></option>
                    <?php foreach($clientes as $iCliente){ ?>
                        <option value="<?=$iCliente->id_usuario;?>"><?=$iCliente->nombre_usuario;?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>