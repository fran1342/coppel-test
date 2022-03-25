<form id="form_productos">

    <?php if(@$producto_seleccionado){ ?> 
        <input type="hidden" name="clave_e" id="clave_e" value="<?=@$producto_seleccionado->id_producto;?>">
        <input type="hidden" name="accion" id="accion" value="<?=@$accion;?>">
    <?php }?>

    <div class="modal-header">
    <?php
        if (@$accion) {
            if ($accion == "borrar") {
                $titulo = "Borrar";
                $titulo2 = $producto_seleccionado->tipo_producto;
                
            }else {
                $titulo = "Editar";
                $titulo2 = $producto_seleccionado->tipo_producto;
            }
      
        }else{
            $titulo = "Registrar";
            $titulo2 = "Selecciona una opci&oacute;n";
        }
  ?>
        
    <h5 class="modal-title">Formulario productos - <?=$titulo?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Nombre:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="nombre_p" id="nombre_p" value="<?=@$producto_seleccionado->nombre_producto;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Descripcion:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="desc_p" id="desc_p" value="<?=@$producto_seleccionado->descripcion_producto;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Precio:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="precio_p" id="precio_p" value="<?=@$producto_seleccionado->precio_producto;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Stock:</label>
                <input type="text" <?=@$accion == "borrar" ? 'disabled' : '';?> class="form-control" name="stock_p" id="stock_p" value="<?=@$producto_seleccionado->stock_producto;?>">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label>Tipo:</label>
                <select class="form-control" <?=@$accion == "borrar" ? 'disabled' : '';?> name="tipo_p" id="tipo_p" value="<?=@$producto_seleccionado->tipo_producto;?>">
                    <option value="" selected disabled><?=$titulo2?></option>
                    <option value="Accesorio">Accesorio</option>
                    <option value="Uso veterinario">Uso Veterinario</option>
                    <option value="Servicio">Servicio</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>